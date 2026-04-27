@extends('admin.layouts.main')

@section('title', 'Applications')

@section('header')
<div class="page-header w-100">
    <div>
        <h3 class="page-title mb-1">All Applications</h3>
        <p class="text-muted mb-0">Manage and review all job applications</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.export', request()->query()) }}" class="btn btn-primary-custom">
            <i class="fas fa-download me-2"></i> Export CSV
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="stat-card mb-4">
    <form method="GET" class="row g-3 align-items-end">
        <div class="col-lg-3">
            <label class="form-label fw-bold" style="font-size: 0.85rem; color: var(--gray);">Search</label>
            <div class="input-group">
                <i class="fas fa-search"></i>
                <input type="text" name="search" class="form-control" placeholder="Name, CNIC, App ID, Mobile" value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-lg-2">
            <label class="form-label fw-bold" style="font-size: 0.85rem; color: var(--gray);">Status</label>
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="pending"     {{ request('status') == 'pending'     ? 'selected' : '' }}>Pending</option>
                <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                <option value="approved"    {{ request('status') == 'approved'    ? 'selected' : '' }}>Approved</option>
                <option value="rejected"    {{ request('status') == 'rejected'    ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label class="form-label fw-bold" style="font-size: 0.85rem; color: var(--gray);">Position</label>
            <select name="position_id" class="form-select">
                <option value="">All Positions</option>
                @foreach($positions as $position)
                <option value="{{ $position->id }}" {{ request('position_id') == $position->id ? 'selected' : '' }}>{{ $position->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2">
            <label class="form-label fw-bold" style="font-size: 0.85rem; color: var(--gray);">From Date</label>
            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>
        <div class="col-lg-2">
            <label class="form-label fw-bold" style="font-size: 0.85rem; color: var(--gray);">To Date</label>
            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>
        <div class="col-lg-1">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-search"></i>
                </button>
                @if(request()->anyFilled(['search', 'status', 'position_id', 'from_date', 'to_date']))
                <a href="{{ route('admin.applications') }}" class="btn" style="background: var(--gray-light);" title="Clear filters">
                    <i class="fas fa-times"></i>
                </a>
                @endif
            </div>
        </div>
    </form>
</div>

<form method="POST" action="{{ route('admin.applications.bulkUpdate') }}" id="bulkForm">
    @csrf
    
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="selectAll">
                <label class="form-check-label" for="selectAll">Select All</label>
            </div>
            <span class="text-muted" id="selectedCount">0 selected</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <select name="status" class="form-select" id="bulkStatusSelect" style="width: auto;">
                <option value="">Bulk Action</option>
                <option value="pending">Mark as Pending</option>
                <option value="shortlisted">Mark as Shortlisted</option>
                <option value="approved">Mark as Approved</option>
                <option value="rejected">Mark as Rejected</option>
            </select>
            <button type="submit" class="btn btn-primary-custom" id="bulkSubmitBtn" disabled>
                Apply
            </button>
        </div>
    </div>

    <div class="data-table">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="40"><input type="checkbox" id="selectAllTop"></th>
                        <th>Application ID</th>
                        <th>Full Name</th>
                        <th>CNIC</th>
                        <th>Mobile</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                    <tr>
                        <td><input type="checkbox" name="application_ids[]" value="{{ $app->id }}" class="app-checkbox"></td>
                        <td><span style="font-weight: 600; color: var(--royal-blue);">{{ $app->application_id }}</span></td>
                        <td class="fw-medium">{{ $app->full_name }}</td>
                        <td><code style="background: rgba(59,130,246,0.08); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">{{ $app->cnic }}</code></td>
                        <td>{{ $app->mobile }}</td>
                        <td><span class="badge" style="background: rgba(59,130,246,0.1); color: var(--royal-blue);">{{ $app->position->title ?? 'N/A' }}</span></td>
                        <td>
                            @if($app->status == 'approved')
                                <span class="badge-custom badge-approved"><i class="fas fa-check me-1"></i>Approved</span>
                            @elseif($app->status == 'rejected')
                                <span class="badge-custom badge-rejected"><i class="fas fa-times me-1"></i>Rejected</span>
                            @elseif($app->status == 'shortlisted')
                                <span class="badge-custom" style="background:rgba(14,165,233,0.15);color:#0284C7;"><i class="fas fa-star me-1"></i>Shortlisted</span>
                            @else
                                <span class="badge-custom badge-pending"><i class="fas fa-clock me-1"></i>Pending</span>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ $app->created_at->format('d M Y') }}</small></td>
                        <td>
                            <a href="{{ route('admin.applications.show', $app->id) }}" class="btn btn-sm action-btn" style="background: var(--royal-blue); color: white;">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <i class="fas fa-inbox fs-1" style="color: var(--gray-light);"></i>
                            <p class="text-muted mt-2 mb-0">No applications found</p>
                            @if(request()->anyFilled(['search', 'status', 'position_id', 'from_date', 'to_date']))
                            <a href="{{ route('admin.applications') }}" class="btn btn-sm btn-primary-custom mt-2">
                                Clear Filters
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</form>

@if($applications->hasPages())
<div class="d-flex justify-content-between align-items-center pagination-wrap mt-4 flex-wrap gap-3">
    <div class="d-flex align-items-center gap-3">
        <span class="text-muted">Show:</span>
        <select class="form-select per-page-select" style="width: auto;">
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
        </select>
        <span class="text-muted">per page</span>
    </div>
    <div class="text-muted">
        Showing {{ $applications->firstItem() ?? 0 }} to {{ $applications->lastItem() ?? 0 }} of {{ $applications->total() }} results
    </div>
    {{ $applications->links() }}
</div>
@endif
@endsection

@section('scripts')
<style>
.input-group { position: relative; }
.input-group i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
    z-index: 3;
}
.input-group .form-control {
    padding-left: 40px;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var perPageSelect = document.querySelector('.per-page-select');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            var params = new URLSearchParams(window.location.search);
            params.set('per_page', this.value);
            window.location.href = window.location.pathname + '?' + params.toString();
        });
    }
    
    var selectAll = document.getElementById('selectAll');
    var selectAllTop = document.getElementById('selectAllTop');
    var checkboxes = document.querySelectorAll('.app-checkbox');
    var selectedCount = document.getElementById('selectedCount');
    var bulkStatusSelect = document.getElementById('bulkStatusSelect');
    var bulkSubmitBtn = document.getElementById('bulkSubmitBtn');
    var bulkForm = document.getElementById('bulkForm');
    
    function updateSelectedCount() {
        var checked = document.querySelectorAll('.app-checkbox:checked');
        selectedCount.textContent = checked.length + ' selected';
        bulkSubmitBtn.disabled = checked.length === 0 || !bulkStatusSelect.value;
    }
    
    [selectAll, selectAllTop].forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            checkboxes.forEach(function(cb) {
                cb.checked = selectAll.checked || selectAllTop.checked;
            });
            updateSelectedCount();
        });
    });
    
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var allChecked = Array.from(checkboxes).every(function(cb) { return cb.checked; });
            var someChecked = Array.from(checkboxes).some(function(cb) { return cb.checked; });
            selectAll.checked = allChecked;
            selectAll.indeterminate = someChecked && !allChecked;
            selectAllTop.checked = allChecked;
            selectAllTop.indeterminate = someChecked && !allChecked;
            updateSelectedCount();
        });
    });
    
    bulkStatusSelect.addEventListener('change', function() {
        updateSelectedCount();
    });
    
    bulkForm.addEventListener('submit', function(e) {
        if (!bulkStatusSelect.value) {
            e.preventDefault();
            alert('Please select a bulk action');
        }
    });
});
</script>
@endsection