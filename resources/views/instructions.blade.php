@extends('layouts.app')

@section('title', 'Instructions')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-3" style="font-size: 2rem;">How to Apply</h2>
        <p class="text-muted" style="font-size: 1.1rem;">Follow these simple steps to complete your application</p>
    </div>
    
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="feature-card h-100 text-center">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="fs-1 fw-bold mb-2" style="color: var(--gray-light);">1</div>
                <h5 class="fw-bold mb-2">Fill Application Form</h5>
                <p class="text-muted mb-0">Complete the online form with your personal, academic, and professional details</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card h-100 text-center">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="fs-1 fw-bold mb-2" style="color: var(--gray-light);">2</div>
                <h5 class="fw-bold mb-2">Download Challan</h5>
                <p class="text-muted mb-0">Download fee challan (Rs.300) from your dashboard and pay at bank or via mobile</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card h-100 text-center">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div class="fs-1 fw-bold mb-2" style="color: var(--gray-light);">3</div>
                <h5 class="fw-bold mb-2">Upload Documents</h5>
                <p class="text-muted mb-0">Login to dashboard and upload your CV + paid fee challan receipt</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card-custom p-4 h-100" style="background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue); border: none; color: white;">
                <h4 class="fw-bold mb-4"><i class="fas fa-university me-2"></i>Fee Payment Details</h4>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(255,255,255,0.1); border-radius: 12px;">
                        <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-money-bill-wave fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Amount</div>
                            <small style="opacity: 0.85;">Rs. 300 (Non-Refundable)</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(255,255,255,0.1); border-radius: 12px;">
                        <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-university fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Bank</div>
                            <small style="opacity: 0.85;">National Bank of Pakistan</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(255,255,255,0.1); border-radius: 12px;">
                        <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-credit-card fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Account Number</div>
                            <small style="opacity: 0.85;">3513609247</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(255,255,255,0.1); border-radius: 12px;">
                        <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-mobile-alt fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Mobile Banking</div>
                            <small style="opacity: 0.85;">JazzCash / Easypaisa</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card-custom p-4 mb-4">
                <h5 class="fw-bold mb-4"><i class="fas fa-gavel me-2" style="color: var(--red);"></i>Important Rules</h5>
                <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                    <li class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle mt-1" style="color: var(--green);"></i>
                        <span>Authority reserves the right to modify or cancel recruitment at any time</span>
                    </li>
                    <li class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle mt-1" style="color: var(--green);"></i>
                        <span>Number of positions may increase or decrease as per requirement</span>
                    </li>
                    <li class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle mt-1" style="color: var(--green);"></i>
                        <span>Salary is attractive and negotiable per qualification and experience</span>
                    </li>
                    <li class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle mt-1" style="color: var(--green);"></i>
                        <span>Candidates can apply for multiple positions (separate fee for each)</span>
                    </li>
                    <li class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle mt-1" style="color: var(--green);"></i>
                        <span>Application fee is non-refundable (for registration only)</span>
                    </li>
                </ul>
            </div>
            
            <div class="card-custom p-4">
                <h5 class="fw-bold mb-4"><i class="fas fa-user-check me-2" style="color: var(--green);"></i>Eligibility Criteria</h5>
                <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                    <li class="d-flex align-items-center gap-2">
                        <i class="fas fa-flag-checkered" style="color: var(--royal-blue);"></i>
                        <span>Pakistani citizens aged 18-45 years</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="fas fa-graduation-cap" style="color: var(--royal-blue);"></i>
                        <span>Minimum qualification as per position requirements</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="fas fa-shield-alt" style="color: var(--royal-blue);"></i>
                        <span>Clean criminal record</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="fas fa-id-card" style="color: var(--royal-blue);"></i>
                        <span>Valid CNIC and mobile number</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-5">
        <a href="{{ route('apply') }}" class="btn btn-orange btn-lg px-5">
            <i class="fas fa-paper-plane me-2"></i> Start Application
        </a>
    </div>
</div>
@endsection