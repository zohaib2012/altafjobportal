@extends('layouts.app')

@section('title', 'Upload Documents')

@section('styles')
<style>
.dashboard-section {
    background: linear-gradient(180deg, var(--light-bg) 0%, var(--white) 100%);
    padding: 60px 0;
    min-height: 70vh;
}

.dashboard-card {
    background: var(--white);
    border: 1px solid var(--gray-light);
    border-radius: 20px;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

.dashboard-header {
    background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);
    padding: 2rem;
}

.status-card {
    background: var(--white);
    border: 1px solid var(--gray-light);
    border-radius: 16px;
    padding: 1.5rem;
    transition: all var(--transition-smooth);
    height: 100%;
}

.status-card:hover {
    border-color: var(--royal-blue);
    box-shadow: var(--shadow-md);
}

.status-card h5 {
    font-size: 0.9rem;
    color: var(--gray);
    margin-bottom: 0.5rem;
}

.status-card .value {
    font-size: 1.5rem;
    font-weight: 800;
    font-family: 'Poppins', sans-serif;
}

.upload-card {
    background: var(--white);
    border: 2px dashed var(--gray-light);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    transition: all var(--transition-smooth);
    height: 100%;
}

.upload-card:hover {
    border-color: var(--royal-blue);
    background: rgba(59,130,246,0.03);
}

.upload-card.dragover {
    border-color: var(--royal-blue);
    background: rgba(59,130,246,0.08);
    transform: scale(1.02);
}

.upload-card h6 {
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.upload-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue));
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--white);
    margin: 0 auto 1rem;
    transition: all var(--transition-smooth);
}

.upload-card:hover .upload-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: var(--shadow-glow);
}

.file-input {
    display: none;
}

.upload-btn {
    background: linear-gradient(135deg, var(--royal-blue), var(--primary-blue));
    border: none;
    color: var(--white);
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    transition: all var(--transition-smooth);
}

.upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-glow);
}

.file-info {
    background: rgba(16,185,129,0.1);
    border: 1px solid rgba(16,185,129,0.2);
    border-radius: 12px;
    padding: 1rem;
    margin-top: 1rem;
}

.file-info i {
    color: var(--green);
}

.progress-bar {
    height: 8px;
    background: var(--gray-light);
    border-radius: 4px;
    overflow: hidden;
    margin-top: 0.5rem;
}

.progress-bar .progress {
    height: 100%;
    background: linear-gradient(90deg, var(--royal-blue), var(--sky-blue));
    border-radius: 4px;
    transition: width 0.3s ease;
}

.no-application {
    background: var(--white);
    border: 1px solid var(--gray-light);
    border-radius: 20px;
    padding: 4rem 2rem;
    text-align: center;
}

.no-application i {
    width: 80px;
    height: 80px;
    background: rgba(59,130,246,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--royal-blue);
    margin: 0 auto 1.5rem;
}

@media (max-width: 768px) {
    .dashboard-header {
        padding: 1.5rem;
    }
    .status-card, .upload-card {
        padding: 1rem;
    }
}
.badge-custom { padding: 0.35rem 0.75rem; border-radius: 8px; font-weight: 600; font-size: 0.75rem; }
.badge-pending  { background: rgba(245,158,11,0.15); color: #D97706; }
.badge-approved { background: rgba(16,185,129,0.15); color: #059669; }
.badge-rejected { background: rgba(239,68,68,0.15);  color: #DC2626; }
</style>
@endsection

@section('content')
<div class="dashboard-section">
    <div class="container">
        <div class="mb-4">
            <div class="dashboard-card d-inline-flex align-items-center gap-3 p-3" style="background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue)); border: none;">
                <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user text-white fs-5"></i>
                </div>
                <div class="text-white">
                    <div class="fw-bold">{{ auth()->user()->name }}</div>
                    <small style="opacity: 0.85;">{{ auth()->user()->email }}</small>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="alert d-flex align-items-center gap-2 mb-4" style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px; padding: 1rem 1.5rem;">
            <i class="fas fa-check-circle text-success fs-5"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if($application)
        <div class="row g-4 mb-4">
            <div class="col-6 col-md-3">
                <div class="status-card">
                    <h5><i class="fas fa-id-card me-1"></i>Application ID</h5>
                    <div class="value" style="color: var(--royal-blue);">{{ $application->application_id }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="status-card">
                    <h5><i class="fas fa-briefcase me-1"></i>Position</h5>
                    <div class="value" style="font-size: 1rem; line-height: 1.4;">{{ $application->position->title ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="status-card">
                    <h5><i class="fas fa-clock me-1"></i>Status</h5>
                    <div class="value">
                        @if($application->status == 'approved')
                            <span class="badge-custom badge-approved"><i class="fas fa-check me-1"></i>Approved</span>
                        @elseif($application->status == 'rejected')
                            <span class="badge-custom badge-rejected"><i class="fas fa-times me-1"></i>Rejected</span>
                        @else
                            <span class="badge-custom badge-pending"><i class="fas fa-clock me-1"></i>Pending</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="status-card">
                    <h5><i class="fas fa-calendar me-1"></i>Submitted</h5>
                    <div class="value" style="font-size: 1rem;">{{ $application->created_at->format('d M Y') }}</div>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="dashboard-header text-white">
                <h4 class="fw-bold mb-1"><i class="fas fa-cloud-upload-alt me-2"></i>Document Upload</h4>
                <p class="mb-0" style="opacity: 0.85;">Upload your CV and paid fee challan to complete the application process</p>
            </div>

            <div class="p-4">

                {{-- Download Challan bar --}}
                @if($challan)
                <div class="mb-4 p-3 d-flex align-items-center justify-content-between flex-wrap gap-3" style="background: rgba(245,158,11,0.08); border-radius: 12px;">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 44px; height: 44px; background: rgba(245,158,11,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-money-bill-wave" style="color: var(--orange-gold);"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Fee Challan — Rs. {{ number_format($challan->total_amount) }}</div>
                            <small class="text-muted">{{ $challan->challan_no }}</small>
                        </div>
                    </div>
                    <a href="{{ route('challan.download', $application->application_id) }}" class="btn btn-primary-custom btn-sm">
                        <i class="fas fa-download me-2"></i> Download Challan PDF
                    </a>
                </div>
                @endif

                {{-- Already uploaded status --}}
                @if(($documents && $documents->cv_path) || ($documents && $documents->challan_path))
                <div class="row g-3 mb-4">
                    @if($documents->cv_path)
                    <div class="col-md-6">
                        <div class="p-3 d-flex align-items-center gap-3" style="background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px;">
                            <i class="fas fa-check-circle text-success fs-5"></i>
                            <div>
                                <div class="fw-bold text-success">CV Uploaded</div>
                                <small class="text-muted">{{ $documents->cv_original_name }}</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($documents->challan_path)
                    <div class="col-md-6">
                        <div class="p-3 d-flex align-items-center gap-3" style="background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px;">
                            <i class="fas fa-check-circle text-success fs-5"></i>
                            <div>
                                <div class="fw-bold text-success">Paid Challan Uploaded</div>
                                <small class="text-muted">{{ $documents->challan_original_name }}</small>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                {{-- Single combined upload form --}}
                <form method="POST" action="{{ route('upload.documents') }}" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div class="row g-4">
                        {{-- CV --}}
                        <div class="col-md-6">
                            <div class="upload-card" id="cvCard">
                                <div class="upload-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <h6><i class="fas fa-file-alt me-2"></i>
                                    {{ ($documents && $documents->cv_path) ? 'Replace CV' : 'Upload CV' }}
                                </h6>
                                <p class="text-muted small mb-3">Accepted: PDF only | Max size: 5MB</p>
                                <input type="file" name="cv" class="form-control @error('cv') is-invalid @enderror"
                                       accept=".pdf"
                                       {{ ($documents && $documents->cv_path) ? '' : 'required' }}>
                                @error('cv')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                @if($documents && $documents->cv_path)
                                <small class="text-muted mt-1 d-block">File select na karein toh purana CV rahega</small>
                                @endif
                            </div>
                        </div>

                        {{-- Paid Challan --}}
                        <div class="col-md-6">
                            <div class="upload-card" id="challanCard" style="border-color: var(--orange-gold);">
                                <div class="upload-icon" style="background: linear-gradient(135deg, var(--orange-gold), #D97706);">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <h6><i class="fas fa-receipt me-2"></i>
                                    {{ ($documents && $documents->challan_path) ? 'Replace Paid Challan' : 'Upload Paid Challan' }}
                                </h6>
                                <p class="text-muted small mb-3">Accepted: PDF, JPG, PNG | Max size: 5MB</p>
                                <input type="file" name="challan" class="form-control @error('challan') is-invalid @enderror"
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       {{ ($documents && $documents->challan_path) ? '' : 'required' }}>
                                @error('challan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                @if($documents && $documents->challan_path)
                                <small class="text-muted mt-1 d-block">File select na karein toh purana challan rahega</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Single Submit Button --}}
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-lg fw-bold px-5 py-3" id="submitBtn"
                                style="background: linear-gradient(135deg, #16A34A, #059669); color: white; border: none; border-radius: 14px; box-shadow: 0 4px 20px rgba(22,163,74,0.4);">
                            <i class="fas fa-cloud-upload-alt me-2"></i> Submit Documents
                        </button>
                        <p class="text-muted small mt-2">CV aur Paid Challan dono upload hone ke baad admin verify karega</p>
                    </div>
                </form>

            </div>
        </div>
        @else
        <div class="no-application">
            <i class="fas fa-file-alt"></i>
            <h4 class="fw-bold mb-2">No Application Found</h4>
            <p class="text-muted mb-4">You haven't submitted an application yet. Apply now to get started!</p>
            <a href="{{ route('apply') }}" class="btn btn-orange">
                <i class="fas fa-paper-plane me-2"></i> Apply Now
            </a>
        </div>
        @endif

        {{-- All Applications History --}}
        @if(isset($allApplications) && $allApplications->count() > 0)
        <div class="dashboard-card mt-4">
            <div class="dashboard-header text-white">
                <h5 class="fw-bold mb-1"><i class="fas fa-history me-2"></i>My All Applications</h5>
                <p class="mb-0" style="opacity:0.85;">Complete application history for your account</p>
            </div>
            <div class="p-3">
                <div class="table-responsive">
                    <table class="table mb-0" style="font-size:0.9rem;">
                        <thead style="background:rgba(59,130,246,0.06);">
                            <tr>
                                <th style="padding:0.75rem 1rem;border:none;font-weight:700;color:var(--dark);">App ID</th>
                                <th style="padding:0.75rem 1rem;border:none;font-weight:700;color:var(--dark);">Position</th>
                                <th style="padding:0.75rem 1rem;border:none;font-weight:700;color:var(--dark);">Fee</th>
                                <th style="padding:0.75rem 1rem;border:none;font-weight:700;color:var(--dark);">Status</th>
                                <th style="padding:0.75rem 1rem;border:none;font-weight:700;color:var(--dark);">Applied On</th>
                                <th style="padding:0.75rem 1rem;border:none;font-weight:700;color:var(--dark);">Challan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allApplications as $app)
                            <tr style="border-bottom:1px solid var(--gray-light);">
                                <td style="padding:0.75rem 1rem;font-weight:700;color:var(--royal-blue);">{{ $app->application_id }}</td>
                                <td style="padding:0.75rem 1rem;">{{ $app->position->title ?? 'N/A' }}</td>
                                <td style="padding:0.75rem 1rem;color:var(--orange-gold);font-weight:600;">Rs. {{ number_format($app->challan->total_amount ?? 300) }}</td>
                                <td style="padding:0.75rem 1rem;">
                                    @if($app->status=='approved')
                                        <span class="badge-custom badge-approved"><i class="fas fa-check me-1"></i>Approved</span>
                                    @elseif($app->status=='rejected')
                                        <span class="badge-custom badge-rejected"><i class="fas fa-times me-1"></i>Rejected</span>
                                    @elseif($app->status=='shortlisted')
                                        <span class="badge-custom" style="background:rgba(14,165,233,0.15);color:#0284C7;padding:0.3rem 0.7rem;border-radius:8px;font-weight:600;font-size:0.75rem;"><i class="fas fa-star me-1"></i>Shortlisted</span>
                                    @else
                                        <span class="badge-custom badge-pending"><i class="fas fa-clock me-1"></i>Pending</span>
                                    @endif
                                </td>
                                <td style="padding:0.75rem 1rem;color:var(--gray);">{{ $app->created_at->format('d M Y') }}</td>
                                <td style="padding:0.75rem 1rem;">
                                    <a href="{{ route('challan.download', $app->application_id) }}" class="btn btn-sm" style="background:rgba(245,158,11,0.15);color:#D97706;border-radius:8px;font-size:0.8rem;font-weight:600;padding:0.3rem 0.75rem;">
                                        <i class="fas fa-download me-1"></i> PDF
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Drag & drop on upload cards
    var cvCard = document.getElementById('cvCard');
    var challanCard = document.getElementById('challanCard');

    [cvCard, challanCard].forEach(function(card) {
        if (!card) return;
        var fileInput = card.querySelector('input[type="file"]');
        if (!fileInput) return;
        card.addEventListener('dragover', function(e) {
            e.preventDefault();
            card.classList.add('dragover');
        });
        card.addEventListener('dragleave', function() {
            card.classList.remove('dragover');
        });
        card.addEventListener('drop', function(e) {
            e.preventDefault();
            card.classList.remove('dragover');
            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
            }
        });
    });

    // AJAX submit — upload files, then navigate to home on success
    var uploadForm = document.getElementById('uploadForm');
    var submitBtn  = document.getElementById('submitBtn');

    if (uploadForm && submitBtn) {
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Uploading...';

            var prevErr = document.getElementById('uploadError');
            if (prevErr) prevErr.remove();

            fetch(uploadForm.action, {
                method: 'POST',
                body: new FormData(uploadForm),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(response) {
                return response.json().then(function(data) {
                    return { ok: response.ok, data: data };
                });
            })
            .then(function(result) {
                if (result.ok && result.data.success) {
                    submitBtn.innerHTML = '<i class="fas fa-check me-2"></i> Uploaded! Redirecting...';
                    window.location.href = result.data.redirect;
                } else {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-cloud-upload-alt me-2"></i> Submit Documents';
                    var messages = '';
                    if (result.data.errors) {
                        Object.values(result.data.errors).forEach(function(errs) {
                            errs.forEach(function(msg) { messages += '<li>' + msg + '</li>'; });
                        });
                    }
                    var errDiv = document.createElement('div');
                    errDiv.id = 'uploadError';
                    errDiv.style.cssText = 'background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.4);border-radius:12px;padding:1rem 1.25rem;margin-top:1rem;color:#dc2626;';
                    errDiv.innerHTML = '<strong>Upload nahi hua:</strong><ul class="mb-0 mt-1 ps-3">' + messages + '</ul>';
                    submitBtn.closest('.text-center').after(errDiv);
                }
            })
            .catch(function() {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-cloud-upload-alt me-2"></i> Submit Documents';
                var errDiv = document.createElement('div');
                errDiv.id = 'uploadError';
                errDiv.style.cssText = 'background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.4);border-radius:12px;padding:1rem 1.25rem;margin-top:1rem;color:#dc2626;';
                errDiv.textContent = 'Network error. Dobara koshish karein.';
                submitBtn.closest('.text-center').after(errDiv);
            });
        });
    }
});
</script>
@endsection
