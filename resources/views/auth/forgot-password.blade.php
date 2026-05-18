@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card-custom">
                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue)); padding: 1.5rem;">
                    <h4 class="fw-bold mb-1"><i class="fas fa-key me-2"></i>Password Reset</h4>
                    <p class="mb-0" style="opacity: 0.85;">Naya password set karein</p>
                </div>
                <div class="card-body p-4">

                    @if(session('success'))
                    <div class="alert text-center mb-4" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);border-radius:12px;padding:1.25rem;">
                        <i class="fas fa-check-circle text-success fs-4 mb-2 d-block"></i>
                        <div class="fw-bold">{{ session('success') }}</div>
                        <a href="{{ route('login') }}" class="btn btn-primary-custom mt-3 w-100">
                            <i class="fas fa-sign-in-alt me-1"></i> Login Karein
                        </a>
                    </div>
                    @else

                    @if($errors->any())
                    <div class="alert mb-3" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:0.75rem;">
                        <i class="fas fa-exclamation-circle text-danger me-1"></i>
                        <span class="text-danger">{{ $errors->first() }}</span>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('forgot.password.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Application mein diya hua email" required value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">New Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Naya password" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Naya password confirm karein" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 py-2">
                            <i class="fas fa-sync me-2"></i> Password Update Karein
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" style="font-size:0.875rem;color:var(--royal-blue);">
                            <i class="fas fa-arrow-left me-1"></i> Wapas Login
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
