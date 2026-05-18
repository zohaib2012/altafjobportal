<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ChallanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PositionsController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/instructions', [HomeController::class, 'instructions'])->name('instructions');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactStore']);

Route::get('/apply', [ApplicationController::class, 'index'])->name('apply')->middleware('auth');
Route::post('/apply', [ApplicationController::class, 'store'])->middleware('auth');
Route::get('/apply/success', [ApplicationController::class, 'success'])->name('apply.success');

Route::get('/challan/{applicationId}/download', [ChallanController::class, 'download'])->name('challan.download');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'processForgotPassword'])->name('forgot.password.update');

// Post-apply upload
Route::get('/apply/upload/{applicationId}', [ApplicationController::class, 'showUploadNow'])->name('apply.upload.now')->middleware('auth');

Route::get('/upload', [AuthController::class, 'dashboard'])->name('upload.dashboard')->middleware('auth');
Route::get('/uploads', [AuthController::class, 'dashboard'])->name('uploads')->middleware('auth');
Route::post('/upload/cv', [DocumentController::class, 'uploadCv'])->name('upload.cv')->middleware('auth');
Route::post('/upload/challan', [DocumentController::class, 'uploadChallan'])->name('upload.challan')->middleware('auth');
Route::post('/upload/documents', [DocumentController::class, 'uploadDocuments'])->name('upload.documents')->middleware('auth');
Route::post('/upload/documents/{applicationId}', [DocumentController::class, 'uploadForApplication'])->name('upload.documents.app')->middleware('auth');
Route::get('/download/{path}', [DocumentController::class, 'download'])->name('document.download')->where('path', '.+');
Route::get('/view/{path}', [DocumentController::class, 'viewInline'])->name('document.view')->where('path', '.+')->middleware('auth');

// ONE CLICK SETUP - Creates tables + admin
Route::get('/quick-setup', function() {
    $output = '<h2>Running Setup...</h2>';
    
    // Check if users table exists
    if (!Schema::hasTable('users')) {
        // Create tables manually
        Schema::create('users', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('candidate');
            $table->unsignedBigInteger('application_id')->nullable();
            $table->timestamps();
        });
        $output .= '<p>✅ Users table created</p>';
    }
    
    // Create admin user
    $admin = User::updateOrCreate(
        ['email' => 'zohaib.khaleed@gmail.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('Admin@1234'),
            'role' => 'admin'
        ]
    );
    
    if ($admin->wasRecentlyCreated) {
        $output .= '<p style="color:green">✅ Admin created!</p>';
    } else {
        $output .= '<p style="color:blue">✅ Admin already exists - updated!</p>';
    }
    
    // Create positions table
    if (!Schema::hasTable('positions')) {
        Schema::create('positions', function ($table) {
            $table->id();
            $table->string('title');
            $table->string('department')->nullable();
            $table->integer('fee_amount')->default(300);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        
        // Seed positions
        DB::table('positions')->insert([
            ['title' => 'Teacher', 'department' => 'Education', 'fee_amount' => 300, 'is_active' => true],
            ['title' => 'Accountant', 'department' => 'Finance', 'fee_amount' => 300, 'is_active' => true],
            ['title' => 'Admin Staff', 'department' => 'Administration', 'fee_amount' => 300, 'is_active' => true],
        ]);
        $output .= '<p>✅ Positions created</p>';
    }
    
    // Create applications table
    if (!Schema::hasTable('applications')) {
        Schema::create('applications', function ($table) {
            $table->id();
            $table->string('application_id')->unique();
            $table->string('full_name');
            $table->string('father_name');
            $table->string('cnic')->unique();
            $table->date('date_of_birth');
            $table->string('mobile');
            $table->string('email');
            $table->text('address');
            $table->string('qualification');
            $table->unsignedBigInteger('position_id');
            $table->string('status')->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
        $output .= '<p>✅ Applications table created</p>';
    }
    
    // Create documents table
    if (!Schema::hasTable('documents')) {
        Schema::create('documents', function ($table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('cv_path')->nullable();
            $table->string('cv_original_name')->nullable();
            $table->integer('cv_size')->nullable();
            $table->timestamp('cv_uploaded_at')->nullable();
            $table->string('challan_path')->nullable();
            $table->string('challan_original_name')->nullable();
            $table->integer('challan_size')->nullable();
            $table->timestamp('challan_uploaded_at')->nullable();
            $table->timestamps();
        });
        $output .= '<p>✅ Documents table created</p>';
    }
    
    // Create challans table
    if (!Schema::hasTable('challans')) {
        Schema::create('challans', function ($table) {
            $table->id();
            $table->string('challan_no')->unique();
            $table->unsignedBigInteger('application_id');
            $table->integer('fee_amount');
            $table->integer('bank_charges')->default(0);
            $table->integer('total_amount');
            $table->timestamps();
        });
        $output .= '<p>✅ Challans table created</p>';
    }
    
    // Create contact_messages table
    if (!Schema::hasTable('contact_messages')) {
        Schema::create('contact_messages', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->timestamps();
        });
        $output .= '<p>✅ Contact Messages table created</p>';
    }
    
    // Create admin_activity_logs table
    if (!Schema::hasTable('admin_activity_logs')) {
        Schema::create('admin_activity_logs', function ($table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('action');
            $table->string('target_type')->nullable();
            $table->unsignedBigInteger('target_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at');
        });
        $output .= '<p>✅ Admin Activity Logs table created</p>';
    }
    
    // Create application_status_history table
    if (!Schema::hasTable('application_status_history')) {
        Schema::create('application_status_history', function ($table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->string('admin_notes')->nullable();
            $table->unsignedBigInteger('changed_by');
            $table->timestamp('changed_at');
        });
        $output .= '<p>✅ Application Status History table created</p>';
    }
    
    $output .= '<hr><h3>Login now:</h3>';
    $output .= '<p><b>Email:</b> zohaib.khaleed@gmail.com</p>';
    $output .= '<p><b>Password:</b> Admin@1234</p>';
    $output .= '<p><a href="/admin/login">Go to Admin Login</a></p>';
    $output .= '<p><a href="/fix-db">Fix DB (remove cnic unique)</a></p>';

    return $output;
});

// Update positions table + seed 13 positions from advertisement
Route::get('/update-positions', function() {
    try {
        // Add new columns to positions if missing (works on MySQL + SQLite + PostgreSQL)
        if (!Schema::hasColumn('positions', 'bps'))
            Schema::table('positions', fn($t) => $t->string('bps')->nullable());
        if (!Schema::hasColumn('positions', 'vacancies'))
            Schema::table('positions', fn($t) => $t->integer('vacancies')->default(0));
        if (!Schema::hasColumn('positions', 'age_limit'))
            Schema::table('positions', fn($t) => $t->string('age_limit')->nullable());
        if (!Schema::hasColumn('positions', 'qualification_required'))
            Schema::table('positions', fn($t) => $t->string('qualification_required')->nullable());
        if (!Schema::hasColumn('positions', 'domicile'))
            Schema::table('positions', fn($t) => $t->string('domicile')->nullable());

        // Add fee verification columns to challans
        if (!Schema::hasColumn('challans', 'is_fee_verified'))
            Schema::table('challans', fn($t) => $t->boolean('is_fee_verified')->default(false));
        if (!Schema::hasColumn('challans', 'fee_verified_at'))
            Schema::table('challans', fn($t) => $t->timestamp('fee_verified_at')->nullable());
        if (!Schema::hasColumn('challans', 'fee_verified_by'))
            Schema::table('challans', fn($t) => $t->unsignedBigInteger('fee_verified_by')->nullable());

        // Update positions safely — never delete (would cascade-delete applications)
        $positionData = [
            ['title'=>'Controller',            'department'=>'Administration', 'bps'=>'Contract', 'vacancies'=>3,    'age_limit'=>'18-48', 'qualification_required'=>'MA',                            'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Managing Director',     'department'=>'Management',     'bps'=>'Contract', 'vacancies'=>6,    'age_limit'=>'18-45', 'qualification_required'=>'MA',                            'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Coordinator',           'department'=>'Coordination',   'bps'=>'Contract', 'vacancies'=>18,   'age_limit'=>'18-45', 'qualification_required'=>'Graduation',                    'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'District Coordinator',  'department'=>'Coordination',   'bps'=>'Contract', 'vacancies'=>35,   'age_limit'=>'18-45', 'qualification_required'=>'Graduation',                    'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Monitoring Officer',    'department'=>'Monitoring',     'bps'=>'Contract', 'vacancies'=>300,  'age_limit'=>'18-45', 'qualification_required'=>'Intermediate',                  'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Assistant',             'department'=>'Administration', 'bps'=>'Contract', 'vacancies'=>370,  'age_limit'=>'18-45', 'qualification_required'=>'Intermediate',                  'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Clerk',                 'department'=>'Administration', 'bps'=>'Contract', 'vacancies'=>400,  'age_limit'=>'18-45', 'qualification_required'=>'Intermediate',                  'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Data Entry Operator',   'department'=>'IT',             'bps'=>'Contract', 'vacancies'=>200,  'age_limit'=>'18-45', 'qualification_required'=>'Intermediate + MS Certificate', 'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Field Officer',         'department'=>'Field',          'bps'=>'Contract', 'vacancies'=>1600, 'age_limit'=>'18-45', 'qualification_required'=>'Intermediate',                  'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Instructor/Teacher',    'department'=>'Education',      'bps'=>'Contract', 'vacancies'=>2500, 'age_limit'=>'18-45', 'qualification_required'=>'Matric/Intermediate',           'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Supporting Staff',      'department'=>'Support',        'bps'=>'Contract', 'vacancies'=>1500, 'age_limit'=>'18-45', 'qualification_required'=>'Primary',                       'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Driver',                'department'=>'Transport',      'bps'=>'Contract', 'vacancies'=>30,   'age_limit'=>'18-30', 'qualification_required'=>'Having License',                'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
            ['title'=>'Cook',                  'department'=>'Support',        'bps'=>'Contract', 'vacancies'=>15,   'age_limit'=>'18-45', 'qualification_required'=>'Educated',                      'domicile'=>'All over Sindh', 'fee_amount'=>450, 'is_active'=>1],
        ];

        foreach ($positionData as $data) {
            \App\Models\Position::updateOrCreate(
                ['title' => $data['title']],
                array_merge($data, ['updated_at' => now()])
            );
        }
        // Deactivate any old positions not in the new list
        $newTitles = array_column($positionData, 'title');
        \App\Models\Position::whereNotIn('title', $newTitles)->update(['is_active' => 0]);

        return '<h2 style="color:green;font-family:sans-serif">✅ Done!</h2>
                <p style="font-family:sans-serif">Positions updated safely (13 positions). Applications NOT deleted.</p>
                <p><a href="/admin">Go to Admin Panel</a> | <a href="/">Go to Home</a></p>';
    } catch (\Exception $e) {
        return '<h2 style="color:red">Error:</h2><p>' . $e->getMessage() . '</p>';
    }
});

// Fix: Remove UNIQUE constraint on cnic so one person can apply for multiple positions
Route::get('/fix-db', function() {
    try {
        $driver = DB::getDriverName();
        $output = "<h2 style='color:green;font-family:sans-serif'>✅ Fix Complete!</h2>";

        if ($driver === 'mysql') {
            // Drop ONLY the single-column cnic unique (not composite ones)
            $singleCnicIndexes = DB::select("
                SELECT s.Key_name FROM information_schema.STATISTICS s
                WHERE s.TABLE_SCHEMA = DATABASE()
                  AND s.TABLE_NAME = 'applications'
                  AND s.Non_unique = 0
                  AND s.Column_name = 'cnic'
                  AND (SELECT COUNT(*) FROM information_schema.STATISTICS s2
                       WHERE s2.TABLE_SCHEMA = DATABASE()
                         AND s2.TABLE_NAME = 'applications'
                         AND s2.Key_name = s.Key_name) = 1
            ");
            foreach ($singleCnicIndexes as $idx) {
                DB::statement("ALTER TABLE applications DROP INDEX `{$idx->Key_name}`");
            }
            $dropped = count($singleCnicIndexes);
            $output .= '<p style="font-family:sans-serif">MySQL: Single-column CNIC unique removed. (' . $dropped . ' dropped)</p>';

            // Add composite unique on (cnic, position_id) — allows same CNIC on different positions
            $composite = DB::select("SHOW INDEX FROM applications WHERE Key_name = 'cnic_position_unique'");
            if (empty($composite)) {
                DB::statement("ALTER TABLE applications ADD UNIQUE KEY `cnic_position_unique` (`cnic`, `position_id`)");
                $output .= '<p style="font-family:sans-serif">MySQL: Composite unique (cnic + position_id) added. ✅</p>';
            } else {
                $output .= '<p style="font-family:sans-serif">MySQL: Composite unique already exists. ✅</p>';
            }

        } elseif ($driver === 'pgsql') {
            $indexes = DB::select("SELECT indexname FROM pg_indexes WHERE tablename='applications' AND indexdef LIKE '%cnic%' AND indexdef NOT LIKE '%position%'");
            foreach ($indexes as $index) {
                DB::statement("DROP INDEX IF EXISTS \"{$index->indexname}\"");
            }
            DB::statement("CREATE UNIQUE INDEX IF NOT EXISTS cnic_position_unique ON applications(cnic, position_id)");
            $output .= '<p style="font-family:sans-serif">PostgreSQL: CNIC unique removed, composite unique added.</p>';

        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=off');
            DB::statement('DROP TABLE IF EXISTS applications_temp');
            DB::statement('CREATE TABLE applications_temp AS SELECT * FROM applications');
            DB::statement('DROP TABLE IF EXISTS applications');
            DB::statement("CREATE TABLE applications (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                application_id VARCHAR NOT NULL UNIQUE,
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
                updated_at DATETIME,
                UNIQUE(cnic, position_id)
            )");
            DB::statement('INSERT INTO applications SELECT * FROM applications_temp');
            DB::statement('DROP TABLE IF EXISTS applications_temp');
            DB::statement('PRAGMA foreign_keys=on');
            $output .= '<p style="font-family:sans-serif">SQLite: CNIC unique removed, composite unique added.</p>';
        }

        $output .= '<p style="font-family:sans-serif"><a href="/apply">Go to Apply</a> | <a href="/">Home</a></p>';
        return $output;

    } catch (\Exception $e) {
        return '<h2 style="color:red">Error:</h2><p>' . $e->getMessage() . '</p>';
    }
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [DashboardController::class, 'showLogin'])->name('login');
    Route::post('/login', [DashboardController::class, 'loginProcess'])->name('login.post');
    Route::get('/otp-verify', [DashboardController::class, 'showOtpVerify'])->name('otp.show');
    Route::post('/otp-verify', [DashboardController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/otp-resend', [DashboardController::class, 'resendOtp'])->name('otp.resend');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Applications
        Route::get('/applications', [DashboardController::class, 'applications'])->name('applications');
        Route::post('/applications/bulk-update', [DashboardController::class, 'bulkUpdateStatus'])->name('applications.bulkUpdate');
        Route::get('/applications/{id}', [DashboardController::class, 'showApplication'])->name('applications.show');
        Route::post('/applications/{id}/status', [DashboardController::class, 'updateStatus'])->name('applications.update');
        Route::post('/applications/{id}/verify-fee', [DashboardController::class, 'verifyFee'])->name('applications.verifyFee');

        // Export
        Route::get('/export', [DashboardController::class, 'export'])->name('export');

        // Positions CRUD
        Route::get('/positions', [PositionsController::class, 'index'])->name('positions');
        Route::get('/positions/create', [PositionsController::class, 'create'])->name('positions.create');
        Route::post('/positions', [PositionsController::class, 'store'])->name('positions.store');
        Route::get('/positions/{id}/edit', [PositionsController::class, 'edit'])->name('positions.edit');
        Route::put('/positions/{id}', [PositionsController::class, 'update'])->name('positions.update');
        Route::delete('/positions/{id}', [PositionsController::class, 'destroy'])->name('positions.destroy');
        Route::post('/positions/{id}/toggle', [PositionsController::class, 'toggle'])->name('positions.toggle');

        // Merit list
        Route::get('/merit-list', [DashboardController::class, 'meritList'])->name('merit-list');

        // Settings
        Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
        Route::post('/settings/password', [DashboardController::class, 'updatePassword'])->name('settings.password');
    });
});