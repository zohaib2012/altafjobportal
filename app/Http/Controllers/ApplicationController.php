<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Position;
use App\Models\Challan;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function index()
    {
        $positions = Position::where('is_active', true)->get();
        return view('apply', compact('positions'));
    }

    public function store(Request $request)
    {
        // PHP-level duplicate check (CNIC + position combo)
        if ($request->cnic && $request->position_id) {
            $exists = Application::where('cnic', $request->cnic)
                ->where('position_id', $request->position_id)
                ->exists();

            if ($exists) {
                return back()->withInput()->withErrors([
                    'cnic' => 'Aap ne is position ke liye pehle se apply kar rakha hai.',
                ]);
            }
        }

        $validator = Validator::make($request->all(), [
            'full_name'     => 'required|string|max:200',
            'father_name'   => 'required|string|max:200',
            'cnic'          => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'email'         => 'required|email|max:200',
            'mobile'        => 'required|string|max:15',
            'address'       => 'required|string',
            'qualification' => 'required|string|max:200',
            'position_id'   => 'required|exists:positions,id',
            'cv'            => 'nullable|file|mimes:pdf|max:5120',
            'challan'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            return DB::transaction(function () use ($validated, $request) {
                $year    = date('Y');
                $lastApp = Application::where('application_id', 'like', "NEPH-{$year}-%")
                    ->orderBy('application_id', 'desc')->first();

                $newNum        = $lastApp ? str_pad((int)substr($lastApp->application_id, -5) + 1, 5, '0', STR_PAD_LEFT) : '00001';
                $applicationId = "NEPH-{$year}-{$newNum}";

                // Handle optional on-spot file uploads
                $cvPath      = null; $cvName      = null; $cvSize      = null;
                $challanPath = null; $challanName = null; $challanSize = null;

                if ($request->hasFile('cv')) {
                    $f = $request->file('cv');
                    $cvPath = $f->store('uploads/cvs');
                    $cvName = $f->getClientOriginalName();
                    $cvSize = $f->getSize();
                }
                if ($request->hasFile('challan')) {
                    $f = $request->file('challan');
                    $challanPath = $f->store('uploads/challans');
                    $challanName = $f->getClientOriginalName();
                    $challanSize = $f->getSize();
                }

                // Auto-approve only if BOTH CV and challan uploaded
                $initialStatus = ($cvPath && $challanPath) ? 'approved' : 'pending';

                $application = Application::create([
                    'application_id' => $applicationId,
                    'user_id'        => Auth::id(),
                    'full_name'      => $validated['full_name'],
                    'father_name'    => $validated['father_name'],
                    'cnic'           => $validated['cnic'],
                    'date_of_birth'  => $validated['date_of_birth'],
                    'mobile'         => $validated['mobile'],
                    'email'          => $validated['email'],
                    'address'        => $validated['address'],
                    'qualification'  => $validated['qualification'],
                    'position_id'    => $validated['position_id'],
                    'status'         => $initialStatus,
                ]);

                $position = Position::find($validated['position_id']);

                Challan::create([
                    'challan_no'     => $applicationId,
                    'application_id' => $application->id,
                    'fee_amount'     => $position->fee_amount,
                    'bank_charges'   => 0,
                    'total_amount'   => $position->fee_amount,
                    'generated_at'   => now(),
                ]);

                Document::create([
                    'application_id'       => $application->id,
                    'cv_path'              => $cvPath,
                    'cv_original_name'     => $cvName,
                    'cv_size'              => $cvSize,
                    'cv_uploaded_at'       => $cvPath ? now() : null,
                    'challan_path'         => $challanPath,
                    'challan_original_name'=> $challanName,
                    'challan_size'         => $challanSize,
                    'challan_uploaded_at'  => $challanPath ? now() : null,
                ]);

                // User is already logged in (apply route requires auth) — just store application_id in session
                Auth::user()->update(['application_id' => $application->id]);

                $request->session()->put('application_id', $applicationId);

                return redirect()->route('apply.upload.now', $application->id);
            });
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = $e->getMessage();
            if ($e->getCode() === '23000' || str_contains($msg, 'UNIQUE constraint failed') || str_contains($msg, 'Duplicate entry')) {
                if (str_contains($msg, 'cnic') || str_contains($msg, 'applications_cnic')) {
                    return back()->withInput()->withErrors([
                        'cnic' => 'Is CNIC se is position par pehle se application submit ho chuki hai.',
                    ]);
                }
            }
            return back()->withInput()->withErrors([
                'general' => 'Database error: ' . $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'general' => 'Kuch masla hua, dobara koshish karein.',
            ]);
        }
    }

    public function showUploadNow($applicationId)
    {
        $user = Auth::user();

        $application = Application::where('id', $applicationId)
            ->where('email', $user->email)
            ->with(['challan', 'position', 'documents'])
            ->firstOrFail();

        return view('apply-upload', compact('application'));
    }

    public function success()
    {
        $applicationId = session('application_id');
        $password      = session('temp_password');

        if (!$applicationId) {
            return redirect()->route('home');
        }

        $application = Application::where('application_id', $applicationId)
            ->with(['challan', 'position'])
            ->first();

        return view('apply-success', [
            'application_id'   => $applicationId,
            'password'         => $password,
            'is_existing_user' => session('is_existing_user', false),
            'application'      => $application,
            'challan'          => $application?->challan,
            'position'         => $application?->position,
        ]);
    }

}
