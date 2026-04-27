@extends('admin.layouts.main')
@section('title', 'Merit List')

@section('header')
<div class="page-header w-100">
    <div>
        <h3 class="page-title mb-1">Merit List</h3>
        <p class="text-muted mb-0">Shortlisted & approved candidates ranked by qualification</p>
    </div>
    @if($positionId && $applications->count())
    <a href="{{ route('admin.export') }}?position_id={{ $positionId }}&status=shortlisted" class="btn btn-primary-custom">
        <i class="fas fa-download me-2"></i> Export
    </a>
    @endif
</div>
@endsection

@section('content')
<div class="stat-card mb-4">
    <form method="GET" class="row g-3 align-items-end">
        <div class="col-md-8">
            <label class="form-label fw-bold" style="font-size:0.85rem;color:var(--gray);">Select Position</label>
            <select name="position_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Select a Position --</option>
                @foreach($positions as $pos)
                <option value="{{ $pos->id }}" {{ $positionId == $pos->id ? 'selected' : '' }}>
                    {{ $pos->title }} ({{ $pos->vacancies ?? 0 }} vacancies)
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary-custom w-100">
                <i class="fas fa-filter me-2"></i> Show Merit List
            </button>
        </div>
    </form>
</div>

@if($positionId)
    @if($selectedPosition)
    <div class="mb-4 p-4" style="background:linear-gradient(135deg,var(--primary-navy),var(--primary-blue));border-radius:16px;color:white;">
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div style="font-size:1.75rem;font-weight:800;font-family:'Poppins',sans-serif;">{{ $applications->count() }}</div>
                <small style="opacity:0.8;">Total in List</small>
            </div>
            <div class="col-6 col-md-3">
                <div style="font-size:1.75rem;font-weight:800;font-family:'Poppins',sans-serif;">{{ $selectedPosition->vacancies ?? 'N/A' }}</div>
                <small style="opacity:0.8;">Vacancies</small>
            </div>
            <div class="col-6 col-md-3">
                <div style="font-size:1.75rem;font-weight:800;font-family:'Poppins',sans-serif;">{{ $selectedPosition->age_limit ?? 'N/A' }}</div>
                <small style="opacity:0.8;">Age Limit</small>
            </div>
            <div class="col-6 col-md-3">
                <div style="font-size:1rem;font-weight:700;font-family:'Poppins',sans-serif;">{{ $selectedPosition->qualification_required ?? 'N/A' }}</div>
                <small style="opacity:0.8;">Required Qual.</small>
            </div>
        </div>
    </div>
    @endif

    @if($applications->count())
    <div class="data-table">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="60">Rank</th>
                        <th>Application ID</th>
                        <th>Full Name</th>
                        <th>Father Name</th>
                        <th>CNIC</th>
                        <th>Qualification</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $i => $app)
                    <tr>
                        <td>
                            <div style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.9rem;
                                background:{{ $i==0 ? 'linear-gradient(135deg,#F59E0B,#D97706)' : ($i==1 ? 'linear-gradient(135deg,#94A3B8,#64748B)' : ($i==2 ? 'linear-gradient(135deg,#C87533,#A0522D)' : 'rgba(59,130,246,0.15)')) }};
                                color:{{ $i < 3 ? 'white' : 'var(--royal-blue)' }};">
                                {{ $i+1 }}
                            </div>
                        </td>
                        <td><span style="font-weight:600;color:var(--royal-blue);">{{ $app->application_id }}</span></td>
                        <td class="fw-bold">{{ $app->full_name }}</td>
                        <td>{{ $app->father_name }}</td>
                        <td><code style="background:rgba(59,130,246,0.08);padding:0.2rem 0.4rem;border-radius:4px;font-size:0.8rem;">{{ $app->cnic }}</code></td>
                        <td><span class="badge" style="background:rgba(16,185,129,0.1);color:#059669;">{{ $app->qualification }}</span></td>
                        <td>{{ $app->mobile }}</td>
                        <td>
                            @if($app->status=='shortlisted')
                                <span class="badge-custom" style="background:rgba(14,165,233,0.15);color:#0284C7;"><i class="fas fa-star me-1"></i>Shortlisted</span>
                            @else
                                <span class="badge-custom badge-approved"><i class="fas fa-check me-1"></i>Approved</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.applications.show', $app->id) }}" class="btn btn-sm action-btn" style="background:var(--royal-blue);color:white;">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="stat-card text-center py-5">
        <i class="fas fa-trophy fs-1 mb-3" style="color:var(--gray-light);"></i>
        <h5 class="text-muted">No shortlisted or approved applications for this position yet.</h5>
        <p class="text-muted small">Shortlist candidates from the Applications page first.</p>
        <a href="{{ route('admin.applications') }}?position_id={{ $positionId }}" class="btn btn-primary-custom mt-2">
            <i class="fas fa-users me-2"></i> View Applications for this Position
        </a>
    </div>
    @endif
@else
<div class="stat-card text-center py-5">
    <i class="fas fa-filter fs-1 mb-3" style="color:var(--gray-light);"></i>
    <h5 class="text-muted">Select a position above to view the merit list.</h5>
</div>
@endif
@endsection
