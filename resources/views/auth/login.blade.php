@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card-custom">
                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue)); padding: 1.5rem;">
                    <h4 class="fw-bold mb-1"><i class="fas fa-sign-in-alt me-2"></i>Candidate Login</h4>
                    <p class="mb-0" style="opacity: 0.85;">Access your dashboard</p>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                    <div class="alert d-flex align-items-center gap-2 mb-4" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 10px; padding: 0.75rem;">
                        <i class="fas fa-exclamation-circle text-danger"></i>
                        <span class="text-danger">{{ $errors->first() }}</span>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>
                    </form>
                    <p class="text-muted small text-center mt-3 mb-0">
                        <i class="fas fa-info-circle me-1"></i> Use the email you provided in your application
                    </p>
                    <hr class="my-3">
                    <p class="text-center mb-0" style="font-size: 0.9rem;">
                        Pehli baar apply kar rahe hain?
                        <a href="{{ route('apply') }}" class="fw-bold" style="color: var(--royal-blue);">
                            <i class="fas fa-paper-plane me-1"></i>Apply Karein
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection