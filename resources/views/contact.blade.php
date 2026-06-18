@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-3" style="font-size: 2rem;">Contact Us</h2>
        <p class="text-muted" style="font-size: 1.1rem;">Have questions? We'd love to hear from you</p>
    </div>
    
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card-custom">
                <div class="card-body p-4">
                    @if(session('success'))
                    <div class="alert d-flex align-items-center gap-2 mb-4" style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px; padding: 1rem;">
                        <i class="fas fa-check-circle text-success"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('contact') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="What is this about?">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Message</label>
                                <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-custom mt-4">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-5">
            <div class="card-custom p-4 mb-4">
                <h5 class="fw-bold mb-4"><i class="fas fa-address-book me-2" style="color: var(--royal-blue);"></i>Contact Information</h5>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 44px; height: 44px; background: rgba(59,130,246,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-map-marker-alt" style="color: var(--royal-blue);"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Address</small>
                            <span class="fw-bold">94/4 Sector 16 A Buffer Zone Karachi Sindh</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 44px; height: 44px; background: rgba(59,130,246,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-phone" style="color: var(--royal-blue);"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Phone</small>
                            <span class="fw-bold">+92 21 3456 7890</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 44px; height: 44px; background: rgba(59,130,246,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-envelope" style="color: var(--royal-blue);"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Email</small>
                            <span class="fw-bold">info@nationaleduportalhub.pk</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 44px; height: 44px; background: rgba(59,130,246,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-globe" style="color: var(--royal-blue);"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Website</small>
                            <span class="fw-bold">www.nationaleduportalhub.pk</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-custom p-4">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue)); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-tie text-white fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Faisal Mehmood</h5>
                        <p class="text-muted mb-0 small">CEO / Project Director</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection