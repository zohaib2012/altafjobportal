@extends('admin.layouts.main')
@section('title', 'Add Position')

@section('header')
<div class="page-header w-100">
    <div>
        <h3 class="page-title mb-1">Add Position</h3>
        <p class="text-muted mb-0">Create a new job position</p>
    </div>
    <a href="{{ route('admin.positions') }}" class="btn btn-primary-custom">
        <i class="fas fa-arrow-left me-2"></i> Back
    </a>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="stat-card">
            <form method="POST" action="{{ route('admin.positions.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Position Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required placeholder="e.g. Field Officer">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">BPS / Grade</label>
                        <input type="text" name="bps" class="form-control" value="{{ old('bps','Contract') }}" placeholder="e.g. Contract / BPS-16">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Department</label>
                        <input type="text" name="department" class="form-control" value="{{ old('department') }}" placeholder="e.g. Education">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Number of Vacancies</label>
                        <input type="number" name="vacancies" class="form-control" value="{{ old('vacancies',0) }}" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Age Limit</label>
                        <input type="text" name="age_limit" class="form-control" value="{{ old('age_limit','18-45') }}" placeholder="e.g. 18-45">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Required Qualification</label>
                        <input type="text" name="qualification_required" class="form-control" value="{{ old('qualification_required') }}" placeholder="e.g. Graduation / Intermediate">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Domicile</label>
                        <input type="text" name="domicile" class="form-control" value="{{ old('domicile','All over Sindh') }}" placeholder="e.g. All over Sindh">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Fee Amount (Rs.) <span class="text-danger">*</span></label>
                        <input type="number" name="fee_amount" class="form-control @error('fee_amount') is-invalid @enderror" value="{{ old('fee_amount',300) }}" min="0" required>
                        @error('fee_amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ old('is_active',1) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="isActive">Active</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom px-4">
                        <i class="fas fa-save me-2"></i> Save Position
                    </button>
                    <a href="{{ route('admin.positions') }}" class="btn" style="background:var(--gray-light);">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
