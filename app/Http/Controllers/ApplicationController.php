<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Position;
use App\Models\Challan;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            'mobile'        => 'required|string|max:15',
            'email'         => 'required|email|max:200',
            'address'       => 'required|string',
            'qualification' => 'required|string|max:200',
            'position_id'   => 'required|exists:positions,id',
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

                $application = Application::create([
                    'application_id' => $applicationId,
                    'full_name'      => $validated['full_name'],
                    'father_name'    => $validated['father_name'],
                    'cnic'           => $validated['cnic'],
                    'date_of_birth'  => $validated['date_of_birth'],
                    'mobile'         => $validated['mobile'],
                    'email'          => $validated['email'],
                    'address'        => $validated['address'],
                    'qualification'  => $validated['qualification'],
                    'position_id'    => $validated['position_id'],
                    'status'         => 'pending',
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

                Document::create(['application_id' => $application->id]);

                $existingUser = User::where('email', $validated['email'])->where('role', 'candidate')->first();
                $password     = null;

                if ($existingUser) {
                    $existingUser->update(['application_id' => $application->id]);
                } else {
                    $password = Str::random(8);
                    User::create([
                        'name'           => $validated['full_name'],
                        'email'          => $validated['email'],
                        'password'       => Hash::make($password),
                        'application_id' => $application->id,
                        'role'           => 'candidate',
                    ]);
                }

                $request->session()->put('application_id', $applicationId);
                $request->session()->put('temp_password', $password);
                $request->session()->put('is_existing_user', $existingUser !== null);

                return redirect()->route('apply.success');
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
