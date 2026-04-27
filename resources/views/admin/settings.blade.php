@extends('admin.layouts.main')
@section('title', 'Settings')

@section('header')
<div class="page-header w-100">
    <div>
        <h3 class="page-title mb-1">Settings</h3>
        <p class="text-muted mb-0">Manage your admin account</p>
    </div>
</div>
@endsection

@section('content')
@if(session('success'))
<div class="alert mb-4" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);border-radius:12px;padding:1rem 1.25rem;">
    <i class="fas fa-check-circle text-success me-2"></i>{{ session('success') }}
</div>
@endif

<div class="row g-4">
    <div class="col-lg-6">
        {{-- Profile Info (read-only) --}}
        <div class="stat-card mb-4">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom:1px solid var(--gray-light);padding-bottom:1rem;">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,var(--royal-blue),var(--sky-blue));border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Admin Profile</h5>
                    <small class="text-muted">Logged-in account details</small>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <div class="p-3" style="background:rgba(59,130,246,0.04);border-radius:10px;">
                        <small class="text-muted d-block mb-1">Name</small>
                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3" style="background:rgba(59,130,246,0.04);border-radius:10px;">
                        <small class="text-muted d-block mb-1">Email</small>
                        <span class="fw-bold">{{ Auth::user()->email }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3" style="background:rgba(59,130,246,0.04);border-radius:10px;">
                        <small class="text-muted d-block mb-1">Role</small>
                        <span class="badge-custom badge-approved"><i class="fas fa-shield-alt me-1"></i>Administrator</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom:1px solid var(--gray-light);padding-bottom:1rem;">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,var(--green),#059669);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-link text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Maintenance</h5>
                    <small class="text-muted">DB utilities</small>
                </div>
            </div>
            <div class="d-grid gap-2">
                <a href="/update-positions" class="btn d-flex align-items-center gap-2 p-3" style="background:rgba(59,130,246,0.08);border:1px solid rgba(59,130,246,0.2);border-radius:10px;color:var(--dark);text-decoration:none;">
                    <i class="fas fa-database" style="color:var(--royal-blue);"></i>
                    <div class="text-start">
                        <div class="fw-bold" style="font-size:0.9rem;">Update Positions from Advertisement</div>
                        <small class="text-muted">Loads 13 positions from the job ad</small>
                    </div>
                </a>
                <a href="/fix-db" class="btn d-flex align-items-center gap-2 p-3" style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.2);border-radius:10px;color:var(--dark);text-decoration:none;">
                    <i class="fas fa-wrench" style="color:var(--orange-gold);"></i>
                    <div class="text-start">
                        <div class="fw-bold" style="font-size:0.9rem;">Fix DB (CNIC Constraint)</div>
                        <small class="text-muted">Allow same CNIC for multiple positions</small>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        {{-- Change Password --}}
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom:1px solid var(--gray-light);padding-bottom:1rem;">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,var(--orange-gold),#D97706);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-lock text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Change Password</h5>
                    <small class="text-muted">Update your login password</small>
                </div>
            </div>

            @if($errors->any())
            <div class="alert mb-3" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:0.875rem 1rem;">
                @foreach($errors->all() as $error)
                <div style="color:#DC2626;font-size:0.875rem;"><i class="fas fa-exclamation-circle me-1"></i>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('admin.settings.password') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Current Password</label>
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required placeholder="Enter current password">
                    @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">New Password</label>
                    <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required placeholder="Min 8 characters">
                    @error('new_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required placeholder="Repeat new password">
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">
                    <i class="fas fa-key me-2"></i> Update Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
