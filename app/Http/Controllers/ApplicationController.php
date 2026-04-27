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
        // Remove sole-CNIC unique constraint from DB if still present
        $this->fixCnicConstraint();

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
            // UNIQUE constraint violation (SQLite error code 23000 / error 19)
            if ($e->getCode() === '23000' || str_contains($e->getMessage(), 'UNIQUE constraint failed')) {
                return back()->withInput()->withErrors([
                    'cnic' => 'Aap ne is position ke liye pehle se apply kar rakha hai.',
                ]);
            }
            return back()->withInput()->withErrors([
                'general' => 'Database error. Dobara koshish karein.',
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

    /**
     * Remove a sole UNIQUE constraint on applications.cnic if present.
     * Allows same CNIC to apply for multiple positions.
     */
    private function fixCnicConstraint(): void
    {
        try {
            DB::statement('PRAGMA foreign_keys=off');

            $indexes = DB::select("PRAGMA index_list('applications')");
            $needsFix = false;

            foreach ($indexes as $index) {
                if (!$index->unique) continue;

                $cols     = DB::select("PRAGMA index_info('{$index->name}')");
                $colNames = collect($cols)->pluck('name')->toArray();

                // Only target a unique index that is solely on 'cnic'
                if ($colNames === ['cnic']) {
                    $needsFix = true;
                    break;
                }
            }

            if ($needsFix) {
                DB::statement('DROP TABLE IF EXISTS _app_fix_tmp');
                DB::statement('CREATE TABLE _app_fix_tmp AS SELECT * FROM applications');
                DB::statement('DROP TABLE applications');
                DB::statement("CREATE TABLE applications (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    application_id VARCHAR NOT NULL,
                    full_name VARCHAR NOT NULL,
                    father_name VARCHAR NOT NULL,
                    cnic VARCHAR NOT NULL,
                    date_of_birth DATE NOT NULL,
                    mobile VARCHAR NOT NULL,
                    email VARCHAR NOT NULL,
                    address TEXT NOT NULL,
                    qualification VARCHAR NOT NULL,
                    position_id INTEGER NOT NULL,
                    status VARCHAR NOT NULL DEFAULT 'pending',
                    admin_notes TEXT,
                    created_at DATETIME,
                    updated_at DATETIME
                )");
                DB::statement('INSERT INTO applications SELECT * FROM _app_fix_tmp');
                DB::statement('DROP TABLE IF EXISTS _app_fix_tmp');
            }

            DB::statement('PRAGMA foreign_keys=on');
        } catch (\Exception $e) {
            DB::statement('PRAGMA foreign_keys=on');
        }
    }
}
