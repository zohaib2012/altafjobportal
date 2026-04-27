@extends('layouts.app')

@section('title', 'Apply Online')

@section('styles')
<style>
.apply-section {
    background: linear-gradient(180deg, var(--light-bg) 0%, var(--white) 100%);
    padding: 60px 0;
    min-height: 70vh;
}

.form-card {
    background: var(--white);
    border: 1px solid var(--gray-light);
    border-radius: 20px;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

.form-header {
    background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.form-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
}

.form-header::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(245,158,11,0.15) 0%, transparent 70%);
}

.step-indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
}

.step {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: rgba(59,130,246,0.1);
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--royal-blue);
}

.step.active {
    background: var(--royal-blue);
    color: var(--white);
}

.step.completed {
    background: var(--green);
    color: var(--white);
}

.form-body {
    padding: 2rem;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--gray-light);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-title i {
    color: var(--royal-blue);
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-group label {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.5rem;
    display: block;
}

.form-group label .required {
    color: var(--red);
}

.agreement-box {
    background: rgba(59,130,246,0.05);
    border: 2px solid var(--gray-light);
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 2rem;
    transition: all var(--transition-normal);
}

.agreement-box:hover {
    border-color: var(--royal-blue);
    background: rgba(59,130,246,0.08);
}

.agreement-box input[type="checkbox"] {
    width: 20px;
    height: 20px;
    accent-color: var(--royal-blue);
}

.submit-btn {
    background: linear-gradient(135deg, var(--orange-gold), #D97706);
    border: none;
    color: var(--dark);
    font-weight: 700;
    padding: 1rem 2rem;
    border-radius: 12px;
    transition: all var(--transition-smooth);
    box-shadow: 0 4px 20px rgba(245,158,11,0.4);
    margin-top: 1.5rem;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(245,158,11,0.5);
    background: linear-gradient(135deg, var(--amber), var(--orange-gold));
}

.info-box {
    background: rgba(239,68,68,0.08);
    border: 1px solid rgba(239,68,68,0.2);
    border-radius: 12px;
    padding: 1.25rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.info-box i {
    color: var(--red);
    font-size: 1.25rem;
    margin-top: 2px;
}

.info-box p {
    margin: 0;
    font-size: 0.95rem;
}

.info-box a {
    color: var(--royal-blue);
    font-weight: 600;
    text-decoration: underline;
}

@media (max-width: 768px) {
    .form-body {
        padding: 1.5rem;
    }
    
    .form-header {
        padding: 1.5rem;
    }
    
    .submit-btn {
        padding: 0.875rem 1.5rem;
    }
}
</style>
@endsection

@section('content')
<div class="apply-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="info-box">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <p class="fw-bold mb-1">Please read all instructions carefully before submitting.</p>
                        <a href="{{ route('instructions') }}">View Instructions <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>

                {{-- Validation Errors --}}
                @if($errors->any())
                <div class="alert mb-4" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.4); border-radius: 12px; padding: 1rem 1.25rem;" id="errorAlert">
                    <div class="d-flex align-items-start gap-2">
                        <i class="fas fa-exclamation-circle text-danger fs-5 mt-1"></i>
                        <div class="flex-grow-1">
                            <strong class="text-danger d-block mb-1">Application submit nahi hui:</strong>
                            <ul class="mb-0 ps-3" style="color: #dc2626;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" onclick="this.closest('#errorAlert').remove()" style="border:none;background:none;color:#dc2626;font-size:1.2rem;">&times;</button>
                    </div>
                </div>
                @endif

                <div class="form-card">
                    <div class="form-header text-white">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <h3 class="fw-bold mb-1"><i class="fas fa-user-plus me-2"></i>Job Application Form</h3>
                                <p class="mb-0" style="opacity: 0.85;">Fill in all details to apply for your dream position</p>
                            </div>
                            <div class="d-flex gap-2">
                                <span class="badge" style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 8px;">
                                    <i class="fas fa-clock me-1"></i> 5 Minutes
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-body">
                        <form method="POST" action="{{ route('apply') }}" id="applicationForm">
                            @csrf
                            
                            <div class="section-title">
                                <i class="fas fa-user"></i> Personal Information
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name <span class="required">*</span></label>
                                        <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="Enter your full name" value="{{ old('full_name') }}" required>
                                        @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Father Name <span class="required">*</span></label>
                                        <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" placeholder="Enter father name" value="{{ old('father_name') }}" required>
                                        @error('father_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CNIC Number <span class="required">*</span></label>
                                        <input type="text" name="cnic" class="form-control @error('cnic') is-invalid @enderror" placeholder="35201-1234567-1" maxlength="15" value="{{ old('cnic') }}" required>
                                        @error('cnic')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <small class="text-muted">Format: 12345-1234567-1</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth <span class="required">*</span></label>
                                        <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                                        @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="section-title mt-4">
                                <i class="fas fa-map-marker-alt"></i> Contact & Location
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile Number <span class="required">*</span></label>
                                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="03XX-XXXXXXX" maxlength="12" value="{{ old('mobile') }}" required>
                                        @error('mobile')<div class="invalid-feedback">{{ $message }}</div>@else<small class="text-muted">Format: 03XX-XXXXXXX</small>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@email.com" value="{{ old('email') }}" required>
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Address <span class="required">*</span></label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" placeholder="Complete mailing address" required>{{ old('address') }}</textarea>
                                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="section-title mt-4">
                                <i class="fas fa-graduation-cap"></i> Academic & Position
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Qualification <span class="required">*</span></label>
                                        <select name="qualification" class="form-select @error('qualification') is-invalid @enderror" required>
                                            <option value="">Select Qualification</option>
                                            @foreach(['Matric','Intermediate','Bachelor','Master','MPhil','PhD','Other'] as $q)
                                            <option value="{{ $q }}" {{ old('qualification') == $q ? 'selected' : '' }}>{{ $q }}</option>
                                            @endforeach
                                        </select>
                                        @error('qualification')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Position Applied For <span class="required">*</span></label>
                                        <select name="position_id" class="form-select @error('position_id') is-invalid @enderror" required>
                                            <option value="">Select Position</option>
                                            @foreach($positions as $position)
                                            <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                                {{ $position->title }} @if($position->department)({{ $position->department }})@endif
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('position_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="agreement-box">
                                <div class="d-flex align-items-start gap-3">
                                    <input type="checkbox" id="terms" required style="margin-top: 4px;">
                                    <label for="terms" class="mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                                        I confirm that all information provided in this application is correct and accurate to the best of my knowledge. I understand that any false information may lead to rejection or termination of my application. I agree to the <a href="{{ route('instructions') }}">terms and conditions</a> and processing fee of Rs. 300 is non-refundable.
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn submit-btn w-100">
                                <i class="fas fa-paper-plane me-2"></i> Submit Application
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cnicInput = document.querySelector('input[name="cnic"]');
    if(cnicInput) {
        cnicInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if(value.length > 5 && value.length < 13) {
                value = value.slice(0,5) + '-' + value.slice(5);
            }
            if(value.length > 13) {
                value = value.slice(0,5) + '-' + value.slice(5,12) + '-' + value.slice(12,13);
            }
            e.target.value = value;
        });
    }
    
    const mobileInput = document.querySelector('input[name="mobile"]');
    if(mobileInput) {
        mobileInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if(value.length > 4) {
                value = value.slice(0,4) + '-' + value.slice(4);
            }
            e.target.value = value;
        });
    }
    
    const form = document.getElementById('applicationForm');
    if(form) {
        form.addEventListener('submit', function() {
            const btn = form.querySelector('button[type="submit"]');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Submitting...';
            btn.disabled = true;
        });
    }
});
</script>
@endsection