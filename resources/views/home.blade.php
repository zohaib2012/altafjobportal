@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero-section text-center" style="position: relative; overflow: hidden;">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-3 fw-bold mb-4 animate-fade-in-up" style="font-family: 'Poppins', sans-serif; line-height: 1.2;">
                    Build Your Future with<br>
                    <span style="background: linear-gradient(135deg, #FCD34D, #F59E0B); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">National EduPortal Hub</span>
                </h1>
                <p class="lead mb-4 animate-fade-in-up animate-delay-1" style="font-size: 1.2rem; opacity: 0.9;">Empowering Pakistan's youth through quality education and career opportunities</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap animate-fade-in-up animate-delay-2">
                    <a href="{{ route('apply') }}" class="btn btn-orange btn-lg px-5 py-3">
                        <i class="fas fa-paper-plane me-2"></i> Apply Online Now
                    </a>
                    <a href="{{ route('instructions') }}" class="btn btn-outline-light btn-lg px-5 py-3">
                        <i class="fas fa-info-circle me-2"></i> View Instructions
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Marketing Messages --}}
@if(isset($marketing) && $marketing->count() > 0)
<div class="container pt-4 pb-0">
    @foreach($marketing as $msg)
    @php
        $styles = [
            'announcement' => ['bg'=>'rgba(59,130,246,0.08)','border'=>'rgba(59,130,246,0.35)','icon'=>'fas fa-bullhorn','color'=>'var(--royal-blue)','badge'=>'rgba(59,130,246,0.15)'],
            'warning'      => ['bg'=>'rgba(245,158,11,0.08)','border'=>'rgba(245,158,11,0.4)','icon'=>'fas fa-exclamation-triangle','color'=>'#D97706','badge'=>'rgba(245,158,11,0.15)'],
            'success'      => ['bg'=>'rgba(16,185,129,0.08)','border'=>'rgba(16,185,129,0.35)','icon'=>'fas fa-check-circle','color'=>'#059669','badge'=>'rgba(16,185,129,0.15)'],
        ];
        $s = $styles[$msg->type] ?? $styles['announcement'];
    @endphp
    <div class="d-flex align-items-start gap-3 p-3 mb-3"
         style="background:{{ $s['bg'] }};border:1.5px solid {{ $s['border'] }};border-radius:14px;">
        <div style="width:38px;height:38px;background:{{ $s['badge'] }};border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="{{ $s['icon'] }}" style="color:{{ $s['color'] }};font-size:1rem;"></i>
        </div>
        <div>
            <div class="fw-bold mb-1" style="color:{{ $s['color'] }};font-size:0.95rem;">{{ $msg->title }}</div>
            <div class="text-muted" style="font-size:0.88rem;line-height:1.5;">{{ $msg->message }}</div>
        </div>
    </div>
    @endforeach
</div>
@endif

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-3" style="font-size: 2rem;">How It Works</h2>
        <p class="text-muted" style="font-size: 1.1rem;">Simple 3-step process to land your dream job</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="feature-card h-100 text-center">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h5 class="fw-bold mb-2">Step 1: Fill Application</h5>
                <p class="text-muted mb-0">Complete the online form with your personal, academic, and professional details</p>
                <div class="mt-3">
                    <span class="badge-custom" style="background: rgba(59,130,246,0.1); color: var(--royal-blue);">5 Minutes</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card h-100 text-center">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-receipt"></i>
                </div>
                <h5 class="fw-bold mb-2">Step 2: Pay Challan</h5>
                <p class="text-muted mb-0">Download fee challan (Rs.450) and pay at any bank or mobile banking</p>
                <div class="mt-3">
                    <span class="badge-custom" style="background: rgba(245,158,11,0.15); color: #D97706;">Rs. 450</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card h-100 text-center">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h5 class="fw-bold mb-2">Step 3: Upload Documents</h5>
                <p class="text-muted mb-0">Login to dashboard and upload your CV + paid fee challan receipt</p>
                <div class="mt-3">
                    <span class="badge-custom" style="background: rgba(16,185,129,0.15); color: #059669;">Instant</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5" style="background: linear-gradient(135deg, var(--primary-navy) 0%, #1E3A8A 100%);">
    <div class="container">
        <div class="row text-center text-white g-4">
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);">
                    <div style="font-size: 2rem; font-weight: 800; font-family: 'Poppins', sans-serif; color: #FCD34D;">50,000+</div>
                    <small style="color: #ffffff; font-weight: 600;">Applications Received</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);">
                    <div style="font-size: 2rem; font-weight: 800; font-family: 'Poppins', sans-serif; color: #FCD34D;">13</div>
                    <small style="color: #ffffff; font-weight: 600;">Open Positions</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);">
                    <div style="font-size: 2rem; font-weight: 800; font-family: 'Poppins', sans-serif; color: #FCD34D;">95%</div>
                    <small style="color: #ffffff; font-weight: 600;">Placement Rate</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);">
                    <div style="font-size: 2rem; font-weight: 800; font-family: 'Poppins', sans-serif; color: #FCD34D;"><i class="fas fa-shield-alt"></i></div>
                    <small style="color: #ffffff; font-weight: 600;">100% Secure</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-3" style="font-size: 2rem;">Available Positions</h2>
        <p class="text-muted" style="font-size: 1.1rem;">Choose the position that matches your qualifications</p>
    </div>
    <div class="row g-4">
        @foreach($positions as $position)
        <div class="col-md-6 col-lg-4">
            <div class="card-custom p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="fw-bold mb-0" style="font-size: 1.1rem;">{{ $position->title }}</h5>
                    <span class="badge-custom" style="background: linear-gradient(135deg, rgba(245,158,11,0.15), rgba(245,158,11,0.25)); color: #D97706;">Rs. {{ number_format($position->fee_amount) }}</span>
                </div>
                @if($position->department)
                <p class="text-muted mb-3" style="font-size: 0.9rem;">{{ $position->department }}</p>
                @endif
                <div class="d-flex align-items-center justify-content-between mt-auto">
                    <span class="text-muted small"><i class="fas fa-clock me-1"></i> Full Time</span>
                    <a href="{{ route('apply') }}" class="btn btn-primary-custom btn-sm">
                        <i class="fas fa-arrow-right me-1"></i> Apply Now
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('apply') }}" class="btn btn-primary-custom btn-lg px-5">
            <i class="fas fa-briefcase me-2"></i> View All Positions
        </a>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <h2 class="fw-bold mb-4" style="font-size: 2rem;">About National EduPortal Hub</h2>
            <p class="text-muted mb-4" style="font-size: 1.05rem; line-height: 1.8;">We are committed to providing quality education and career opportunities to the talented youth of Pakistan. Our portal connects qualified candidates with leading educational institutions and organizations across the country.</p>
            
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="feature-icon" style="width: 48px; height: 48px; font-size: 1.2rem;">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Verified</div>
                            <small class="text-muted">Certifications</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="feature-icon" style="width: 48px; height: 48px; font-size: 1.2rem;">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Trusted</div>
                            <small class="text-muted">by Top Institutions</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-custom p-4" style="background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue); border: none;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-tie fs-4 text-white"></i>
                    </div>
                    <div class="text-white">
                        <div class="fw-bold" style="font-size: 1.1rem;">Faisal Mehmood</div>
                        <small style="opacity: 0.8;">CEO / Project Director</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-custom p-4">
                <h5 class="fw-bold mb-4"><i class="fas fa-info-circle me-2" style="color: var(--royal-blue);"></i>Fee Payment Information</h5>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(59,130,246,0.05); border-radius: 10px;">
                        <div style="width: 44px; height: 44px; background: rgba(59,130,246,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--royal-blue);">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Processing Fee</div>
                            <small class="text-muted">Rs. 450 (Non-Refundable)</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(245,158,11,0.05); border-radius: 10px;">
                        <div style="width: 44px; height: 44px; background: rgba(245,158,11,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--orange-gold);">
                            <i class="fas fa-university"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Bank Deposit</div>
                            <small class="text-muted">National Bank of Pakistan</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(16,185,129,0.05); border-radius: 10px;">
                        <div style="width: 44px; height: 44px; background: rgba(16,185,129,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--green);">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Mobile Banking</div>
                            <small class="text-muted">JazzCash / Easypaisa</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center py-5">
    <h3 class="fw-bold mb-3">Ready to Start Your Career?</h3>
    <p class="text-muted mb-4">Join thousands of candidates who have already applied</p>
    <a href="{{ route('apply') }}" class="btn btn-orange btn-lg px-5 py-3">
        <i class="fas fa-paper-plane me-2"></i> Apply Now
    </a>
</div>
@endsection