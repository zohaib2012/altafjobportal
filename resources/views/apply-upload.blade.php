@extends('layouts.app')

@section('title', 'Upload Documents')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-4">
                <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #16A34A, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <i class="fas fa-check text-white fs-2"></i>
                </div>
                <h2 class="fw-bold mb-2">Application Submitted!</h2>
                <p class="text-muted fs-5">Application ID: <strong style="color: var(--primary-blue);">{{ $application->application_id }}</strong></p>
                <p class="text-muted mb-3">Challan bhi ready hai &mdash; download kar ke bank mein jama karein.</p>
                @if($application->challan)
                <a href="{{ route('challan.download', $application->application_id) }}"
                   class="btn btn-lg fw-bold px-5 py-2 mb-2"
                   style="background: linear-gradient(135deg, #F59E0B, #D97706); color: #1a1a1a; border: none; border-radius: 12px; box-shadow: 0 4px 16px rgba(245,158,11,0.4);">
                    <i class="fas fa-download me-2"></i> Download Fee Challan
                    <span class="ms-2 opacity-75" style="font-size:0.85rem;">Rs. {{ number_format($application->challan->total_amount) }}</span>
                </a>
                @endif
            </div>

            <div class="card-custom p-4 mb-4">
                <h5 class="fw-bold mb-3"><i class="fas fa-cloud-arrow-up me-2" style="color: var(--royal-blue);"></i>Upload Documents Now</h5>
                @if(session('success'))
                <div class="alert d-flex align-items-center gap-2 mb-4" style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 10px; padding: 0.75rem;">
                    <i class="fas fa-check-circle text-success"></i>
                    <span class="text-success">{{ session('success') }}</span>
                </div>
                @endif
                @if($errors->any())
                <div class="alert d-flex align-items-center gap-2 mb-4" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 10px; padding: 0.75rem;">
                    <i class="fas fa-exclamation-circle text-danger"></i>
                    <span class="text-danger">{{ $errors->first() }}</span>
                </div>
                @endif

                <form action="{{ route('upload.documents.app', $application->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="from" value="apply_upload">
                    <div class="mb-3">
                        <label for="cv" class="form-label fw-bold">Upload CV <small class="text-muted">(PDF only, Max 5MB)</small></label>
                        <input class="form-control" type="file" id="cv" name="cv" accept=".pdf">
                        @if($application->documents && $application->documents->cv_path)
                        <small class="text-success mt-1 d-block">Current CV: <a href="{{ route('document.view', $application->documents->cv_path) }}" target="_blank" class="text-success fw-bold">View</a> (Uploaded: {{ $application->documents->cv_uploaded_at->format('M d, Y') }})</small>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label for="challan" class="form-label fw-bold">Upload Paid Challan <small class="text-muted">(PDF/JPG/PNG, Max 5MB)</small></label>
                        <input class="form-control" type="file" id="challan" name="challan" accept=".pdf,.jpg,.jpeg,.png">
                        @if($application->documents && $application->documents->challan_path)
                        <small class="text-success mt-1 d-block">Current Challan: <a href="{{ route('document.view', $application->documents->challan_path) }}" target="_blank" class="text-success fw-bold">View</a> (Uploaded: {{ $application->documents->challan_uploaded_at->format('M d, Y') }})</small>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100 py-2">
                        <i class="fas fa-upload me-2"></i> Upload
                    </button>
                </form>
            </div>

            <div class="text-center">
                <a href="{{ route('upload.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-right me-2"></i> upload later
                </a>
            </div>
        </div>
    </div>
</div>
@endsection