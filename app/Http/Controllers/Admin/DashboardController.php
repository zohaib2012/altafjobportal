<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application;
use App\Models\Position;
use App\Models\ApplicationStatusHistory;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $stats = [
                'total'       => Application::count(),
                'pending'     => Application::where('status', 'pending')->count(),
                'shortlisted' => Application::where('status', 'shortlisted')->count(),
                'approved'    => Application::where('status', 'approved')->count(),
                'rejected'    => Application::where('status', 'rejected')->count(),
            ];

            // Chart: applications per position
            $positions      = Position::withCount('applications')->get();
            $chartLabels    = $positions->pluck('title');
            $chartData      = $positions->pluck('applications_count');

            // Chart: status breakdown
            $statusLabels = ['Pending', 'Shortlisted', 'Approved', 'Rejected'];
            $statusData   = [
                $stats['pending'],
                $stats['shortlisted'],
                $stats['approved'],
                $stats['rejected'],
            ];

            $recentApps = Application::with('position')
                ->orderBy('created_at', 'desc')
                ->limit(10)->get();

            $recentLogs = AdminActivityLog::with('admin')
                ->orderBy('created_at', 'desc')
                ->limit(10)->get();
        } catch (\Exception $e) {
            $stats        = ['total' => 0, 'pending' => 0, 'shortlisted' => 0, 'approved' => 0, 'rejected' => 0];
            $chartLabels  = collect();
            $chartData    = collect();
            $statusLabels = [];
            $statusData   = [];
            $recentApps   = collect();
            $recentLogs   = collect();
        }

        return view('admin.dashboard', compact(
            'stats', 'recentApps', 'recentLogs',
            'chartLabels', 'chartData', 'statusLabels', 'statusData'
        ));
    }

    public function applications(Request $request)
    {
        $query = Application::with('position');

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name',      'like', "%{$search}%")
                  ->orWhere('cnic',         'like', "%{$search}%")
                  ->orWhere('application_id','like', "%{$search}%")
                  ->orWhere('mobile',       'like', "%{$search}%")
                  ->orWhere('email',        'like', "%{$search}%");
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->position_id) {
            $query->where('position_id', $request->position_id);
        }

        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $perPage      = in_array($request->per_page, [10, 25, 50, 100]) ? $request->per_page : 20;
        $applications = $query->orderBy('created_at', 'desc')
                              ->paginate($perPage)
                              ->appends($request->query()); // ← fixes filter + pagination

        $positions = Position::where('is_active', true)->get();

        return view('admin.applications.index', compact('applications', 'positions'));
    }

    public function showApplication($id)
    {
        $application = Application::with(
            'position', 'documents', 'challan',
            'statusHistory', 'statusHistory.admin'
        )->findOrFail($id);

        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        $request->validate([
            'status'      => 'required|in:pending,shortlisted,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $oldStatus = $application->status;

        $application->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'old_status'     => $oldStatus,
            'new_status'     => $request->status,
            'admin_notes'    => $request->admin_notes,
            'changed_by'     => Auth::id(),
            'changed_at'     => now(),
        ]);

        AdminActivityLog::create([
            'admin_id'    => Auth::id(),
            'action'      => 'status_update',
            'target_type' => 'Application',
            'target_id'   => $application->id,
            'description' => "Changed status from {$oldStatus} to {$request->status} for application {$application->application_id}",
            'created_at'  => now(),
        ]);

        return back()->with('success', 'Application status updated!');
    }

    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'application_ids'   => 'required|array',
            'application_ids.*' => 'exists:applications,id',
            'status'            => 'required|in:pending,shortlisted,approved,rejected',
            'admin_notes'       => 'nullable|string',
        ]);

        $count = 0;
        foreach ($request->application_ids as $appId) {
            $application = Application::find($appId);
            if ($application) {
                $oldStatus = $application->status;
                $application->update([
                    'status'      => $request->status,
                    'admin_notes' => $request->admin_notes,
                ]);
                ApplicationStatusHistory::create([
                    'application_id' => $application->id,
                    'old_status'     => $oldStatus,
                    'new_status'     => $request->status,
                    'admin_notes'    => $request->admin_notes,
                    'changed_by'     => Auth::id(),
                    'changed_at'     => now(),
                ]);
                $count++;
            }
        }

        AdminActivityLog::create([
            'admin_id'    => Auth::id(),
            'action'      => 'bulk_status_update',
            'target_type' => 'Application',
            'description' => "Bulk updated {$count} applications to {$request->status}",
            'created_at'  => now(),
        ]);

        return back()->with('success', "{$count} applications updated!");
    }

    public function export(Request $request)
    {
        $query = Application::with('position');

        if ($request->status)      $query->where('status', $request->status);
        if ($request->position_id) $query->where('position_id', $request->position_id);
        if ($request->from_date)   $query->whereDate('created_at', '>=', $request->from_date);
        if ($request->to_date)     $query->whereDate('created_at', '<=', $request->to_date);

        $applications = $query->orderBy('created_at', 'desc')->get();

        $csv   = [];
        $csv[] = ['App ID', 'Name', 'Father Name', 'CNIC', 'Mobile', 'Email', 'Position', 'Qualification', 'Status', 'Date Applied', 'Last Updated'];

        foreach ($applications as $app) {
            $csv[] = [
                $app->application_id,
                $app->full_name,
                $app->father_name,
                $app->cnic,
                $app->mobile,
                $app->email,
                $app->position->title ?? 'N/A',
                $app->qualification,
                $app->status,
                $app->created_at->format('Y-m-d'),
                $app->updated_at->format('Y-m-d H:i'),
            ];
        }

        $content = implode("\n", array_map(function ($row) {
            return implode(",", array_map(fn($item) => '"' . str_replace('"', '""', $item) . '"', $row));
        }, $csv));

        return Response::make($content, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=applications_' . date('Y-m-d_His') . '.csv',
        ]);
    }

    public function meritList(Request $request)
    {
        $positions      = Position::where('is_active', true)->get();
        $positionId     = $request->position_id;
        $qualOrder      = ['PhD', 'MPhil', 'Master', 'MA', 'Graduation', 'Bachelor', 'Intermediate', 'Matric/Intermediate', 'Intermediate +Ms Certificate', 'Matric', 'Primary', 'Having License', 'Educated', 'Other'];
        $applications   = collect();
        $selectedPosition = null;

        if ($positionId) {
            $selectedPosition = Position::find($positionId);
            $applications = Application::with('position')
                ->where('position_id', $positionId)
                ->whereIn('status', ['shortlisted', 'approved'])
                ->get()
                ->sortBy(function ($app) use ($qualOrder) {
                    $idx = array_search($app->qualification, $qualOrder);
                    return $idx === false ? 999 : $idx;
                })
                ->values();
        }

        return view('admin.merit-list', compact('positions', 'applications', 'positionId', 'selectedPosition'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        AdminActivityLog::create([
            'admin_id'    => $user->id,
            'action'      => 'password_change',
            'description' => 'Admin changed password',
            'created_at'  => now(),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    public function verifyFee(Request $request, $id)
    {
        $application = Application::with('challan')->findOrFail($id);

        if ($application->challan) {
            $verified = !($application->challan->is_fee_verified ?? false);
            $application->challan->update([
                'is_fee_verified'  => $verified,
                'fee_verified_at'  => $verified ? now() : null,
                'fee_verified_by'  => $verified ? Auth::id() : null,
            ]);

            $label = $verified ? 'verified' : 'unverified';
            AdminActivityLog::create([
                'admin_id'    => Auth::id(),
                'action'      => 'fee_verification',
                'target_type' => 'Application',
                'target_id'   => $application->id,
                'description' => "Fee marked as {$label} for {$application->application_id}",
                'created_at'  => now(),
            ]);
        }

        return back()->with('success', 'Fee status updated!');
    }

    public function showLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        return $this->loginProcess($request);
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password) || $user->role !== 'admin') {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        Auth::login($user);

        AdminActivityLog::create([
            'admin_id'    => $user->id,
            'action'      => 'login',
            'description' => 'Admin logged in',
            'created_at'  => now(),
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        $user = Auth::user();

        AdminActivityLog::create([
            'admin_id'    => $user->id,
            'action'      => 'logout',
            'description' => 'Admin logged out',
            'created_at'  => now(),
        ]);

        Auth::logout();
        return redirect()->route('admin.login');
    }
}
