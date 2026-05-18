@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card-custom">
                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue)); padding: 1.5rem;">
                    <h4 class="fw-bold mb-1"><i class="fas fa-user-plus me-2"></i>Candidate Registration</h4>
                    <p class="mb-0" style="opacity: 0.85;">Create your account</p>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                    <div class="alert d-flex align-items-center gap-2 mb-4" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 10px; padding: 0.75rem;">
                        <i class="fas fa-exclamation-circle text-danger"></i>
                        <span class="text-danger">{{ $errors->first() }}</span>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your Full Name" required value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 py-2">
                            <i class="fas fa-user-plus me-2"></i> Register
                        </button>
                    </form>
                    <hr class="my-3">
                    <p class="text-center mb-0" style="font-size: 0.9rem;">
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-bold" style="color: var(--royal-blue);">
                            <i class="fas fa-sign-in-alt me-1"></i> Login Here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection