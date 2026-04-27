@extends('admin.layouts.main')

@section('title', 'Application Details')

@section('header')
<div class="page-header w-100">
    <div>
        <h3 class="page-title mb-1">Application Details</h3>
        <p class="text-muted mb-0">Reviewing application {{ $application->application_id }}</p>
    </div>
    <a href="{{ route('admin.applications') }}" class="btn btn-primary-custom">
        <i class="fas fa-arrow-left me-2"></i> Back to List
    </a>
</div>
@endsection

@section('content')
@if(session('success'))
<div class="alert d-flex align-items-center gap-2 mb-4" style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px; padding: 1rem 1.5rem;">
    <i class="fas fa-check-circle text-success fs-5"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="stat-card mb-4">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom: 1px solid var(--gray-light); padding-bottom: 1rem;">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue)); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user text-white fs-5"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1">Personal Information</h4>
                    <p class="text-muted mb-0">Application ID: <span style="font-weight: 600; color: var(--royal-blue);">{{ $application->application_id }}</span></p>
                </div>
                <div class="ms-auto">
                    @if($application->status == 'approved')
                        <span class="badge-custom badge-approved"><i class="fas fa-check me-1"></i>Approved</span>
                    @elseif($application->status == 'rejected')
                        <span class="badge-custom badge-rejected"><i class="fas fa-times me-1"></i>Rejected</span>
                    @else
                        <span class="badge-custom badge-pending"><i class="fas fa-clock me-1"></i>Pending</span>
                    @endif
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(59,130,246,0.04); border-radius: 10px;">
                        <small class="text-muted d-block mb-1">Full Name</small>
                        <span class="fw-bold">{{ $application->full_name }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(59,130,246,0.04); border-radius: 10px;">
                        <small class="text-muted d-block mb-1">Father Name</small>
                        <span class="fw-bold">{{ $application->father_name }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(59,130,236,0.04); border-radius: 10px;">
                        <small class="text-muted d-block mb-1">CNIC Number</small>
                        <code style="font-size: 1rem;">{{ $application->cnic }}</code>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(59,130,246,0.04); border-radius: 10px;">
                        <small class="text-muted d-block mb-1">Date of Birth</small>
                        <span class="fw-bold">{{ $application->date_of_birth->format('d M Y') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(59,130,246,0.04); border-radius: 10px;">
                        <small class="text-muted d-block mb-1">Mobile Number</small>
                        <span class="fw-bold">{{ $application->mobile }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(59,130,246,0.04); border-radius: 10px;">
                        <small class="text-muted d-block mb-1">Email Address</small>
                        <span class="fw-bold">{{ $application->email }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(59,130,246,0.04); border-radius: 10px;">
                        <small class="text-muted d-block mb-1">Qualification</small>
                        <span class="fw-bold">{{ $application->qualification }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(59,130,246,0.04); border-radius: 10px;">
                        <small class="text-muted d-block mb-1">Position Applied</small>
                        <span class="fw-bold" style="color: var(--royal-blue);">{{ $application->position->title ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3" style="background: rgba(59,130,246,0.04); border-radius: 10px;">
                        <small class="text-muted d-block mb-1">Address</small>
                        <span class="fw-bold">{{ $application->address }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom: 1px solid var(--gray-light); padding-bottom: 1rem;">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, var(--green), #059669); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-file-alt text-white fs-5"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1">Uploaded Documents</h4>
                    <p class="text-muted mb-0">CV and Paid Challan</p>
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-4 text-center" style="background: rgba(59,130,246,0.04); border-radius: 12px;">
                        <i class="fas fa-file-pdf fs-1 mb-3" style="color: var(--red);"></i>
                        <h6 class="fw-bold">CV Document</h6>
                        @if($application->documents && $application->documents->cv_path)
                            <div class="mt-3 p-2" style="background: rgba(16,185,129,0.1); border-radius: 8px;">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold text-success">Uploaded</span>
                                <p class="text-muted mb-0 small">{{ $application->documents->cv_original_name }}</p>
                            </div>
                            <a href="{{ route('document.download', $application->documents->cv_path) }}" class="btn btn-primary-custom mt-3">
                                <i class="fas fa-download me-2"></i> Download CV
                            </a>
                        @else
                            <p class="text-muted mt-3 mb-0">Not uploaded yet</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 text-center" style="background: rgba(59,130,246,0.04); border-radius: 12px;">
                        <i class="fas fa-receipt fs-1 mb-3" style="color: var(--orange-gold);"></i>
                        <h6 class="fw-bold">Paid Challan</h6>
                        @if($application->documents && $application->documents->challan_path)
                            @php
                                $ext = strtolower(pathinfo($application->documents->challan_original_name, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png']);
                            @endphp
                            <div class="mt-3 p-2" style="background: rgba(16,185,129,0.1); border-radius: 8px;">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-bold text-success">Uploaded</span>
                                <p class="text-muted mb-0 small">{{ $application->documents->challan_original_name }}</p>
                            </div>
                            @if($isImage)
                                <div class="mt-3">
                                    <img src="{{ route('document.view', $application->documents->challan_path) }}"
                                         alt="Paid Challan"
                                         class="img-fluid rounded"
                                         style="max-height: 300px; cursor: pointer; border: 1px solid #dee2e6;"
                                         onclick="document.getElementById('challanModal').style.display='flex'">
                                    <p class="text-muted small mt-1"><i class="fas fa-search-plus me-1"></i>Click image to enlarge</p>
                                </div>
                                {{-- Lightbox Modal --}}
                                <div id="challanModal"
                                     onclick="this.style.display='none'"
                                     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.85); z-index:9999; align-items:center; justify-content:center; cursor:zoom-out;">
                                    <img src="{{ route('document.view', $application->documents->challan_path) }}"
                                         style="max-width:90%; max-height:90vh; border-radius:8px; box-shadow:0 0 30px rgba(0,0,0,0.5);">
                                </div>
                            @endif
                            <a href="{{ route('document.download', $application->documents->challan_path) }}" class="btn btn-primary-custom mt-3">
                                <i class="fas fa-download me-2"></i> Download Challan
                            </a>
                        @else
                            <p class="text-muted mt-3 mb-0">Not uploaded yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="stat-card mb-4">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom: 1px solid var(--gray-light); padding-bottom: 1rem;">
                <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue)); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-edit text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Update Status</h5>
                    <p class="text-muted mb-0 small">Change application status</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('admin.applications.update', $application->id) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Update To</label>
                    <select name="status" class="form-select" required>
                        <option value="pending"     {{ $application->status == 'pending'     ? 'selected' : '' }}>Pending</option>
                        <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                        <option value="approved"    {{ $application->status == 'approved'    ? 'selected' : '' }}>Approved</option>
                        <option value="rejected"    {{ $application->status == 'rejected'    ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Admin Notes</label>
                    <textarea name="admin_notes" class="form-control" rows="4" placeholder="Add notes about this application...">{{ $application->admin_notes }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">
                    <i class="fas fa-save me-2"></i> Update Status
                </button>
            </form>

            {{-- Fee Verification --}}
            @if($application->challan)
            <form method="POST" action="{{ route('admin.applications.verifyFee', $application->id) }}" class="mt-3">
                @csrf
                @if($application->challan->is_fee_verified)
                <button type="submit" class="btn w-100" style="background:rgba(239,68,68,0.1);border:1.5px solid rgba(239,68,68,0.4);color:#DC2626;border-radius:10px;font-weight:600;">
                    <i class="fas fa-times-circle me-2"></i> Mark Fee Unverified
                </button>
                <p class="text-muted small text-center mt-1">Verified {{ $application->challan->fee_verified_at?->format('d M Y') }}</p>
                @else
                <button type="submit" class="btn w-100" style="background:rgba(16,185,129,0.1);border:1.5px solid rgba(16,185,129,0.4);color:#059669;border-radius:10px;font-weight:600;">
                    <i class="fas fa-check-circle me-2"></i> Mark Fee Verified
                </button>
                @endif
            </form>
            @endif
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom: 1px solid var(--gray-light); padding-bottom: 1rem;">
                <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--orange-gold), #D97706); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-money-bill-wave text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Fee Challan</h5>
                    <p class="text-muted mb-0 small">Payment details</p>
                </div>
            </div>
            
            @if($application->challan)
            <div class="text-center">
                <div class="p-3 mb-3" style="background: rgba(245,158,11,0.1); border-radius: 12px;">
                    <div class="fs-4 fw-bold" style="color: var(--orange-gold);">Rs. {{ number_format($application->challan->total_amount) }}</div>
                    <small class="text-muted">{{ $application->challan->challan_no }}</small>
                </div>
                <a href="{{ route('challan.download', $application->application_id) }}" class="btn btn-orange w-100">
                    <i class="fas fa-download me-2"></i> Download Challan
                </a>
            </div>
            @else
            <p class="text-muted text-center">No challan found</p>
            @endif
        </div>

        @if($application->statusHistory && $application->statusHistory->count() > 0)
        <div class="stat-card mt-4">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom: 1px solid var(--gray-light); padding-bottom: 1rem;">
                <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue)); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-history text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Status History</h5>
                    <p class="text-muted mb-0 small">Previous status changes</p>
                </div>
            </div>
            
            <div class="d-flex flex-column gap-2">
                @foreach($application->statusHistory as $history)
                <div class="d-flex align-items-center gap-3 p-2" style="background: rgba(59,130,246,0.04); border-radius: 8px;">
                    <div style="width: 32px; height: 32px; background: var(--royal-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem;">
                        {{ $loop->iteration }}
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge badge-pending">{{ $history->new_status }}</span>
                            @if($history->old_status)
                            <small class="text-muted">(was: {{ $history->old_status }})</small>
                            @endif
                        </div>
                        <small class="text-muted">{{ $history->changed_at->format('d M Y, g:i A') }}</small>
                    </div>
                    @if($history->admin)
                    <div class="text-end">
                        <small class="text-muted">{{ $history->admin->name }}</small>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection