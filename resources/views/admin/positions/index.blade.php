@extends('admin.layouts.main')
@section('title', 'Positions')

@section('header')
<div class="page-header w-100">
    <div>
        <h3 class="page-title mb-1">Manage Positions</h3>
        <p class="text-muted mb-0">Add, edit or deactivate job positions</p>
    </div>
    <a href="{{ route('admin.positions.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Add Position
    </a>
</div>
@endsection

@section('content')
@if(session('success'))
<div class="alert mb-4" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);border-radius:12px;padding:1rem 1.25rem;">
    <i class="fas fa-check-circle text-success me-2"></i>{{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert mb-4" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:12px;padding:1rem 1.25rem;">
    <i class="fas fa-exclamation-circle text-danger me-2"></i>{{ session('error') }}
</div>
@endif

<div class="data-table">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Position Title</th>
                    <th>BPS</th>
                    <th>Vacancies</th>
                    <th>Age Limit</th>
                    <th>Qualification</th>
                    <th>Domicile</th>
                    <th>Fee</th>
                    <th>Applications</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($positions as $position)
                <tr>
                    <td class="text-muted" style="font-size:0.85rem;">{{ $loop->iteration }}</td>
                    <td>
                        <div class="fw-bold">{{ $position->title }}</div>
                        @if($position->department)<small class="text-muted">{{ $position->department }}</small>@endif
                    </td>
                    <td><span class="badge" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);">{{ $position->bps ?? 'N/A' }}</span></td>
                    <td><span class="fw-bold" style="color:var(--primary-navy);">{{ number_format($position->vacancies ?? 0) }}</span></td>
                    <td>{{ $position->age_limit ?? 'N/A' }}</td>
                    <td style="max-width:150px;white-space:normal;font-size:0.85rem;">{{ $position->qualification_required ?? 'N/A' }}</td>
                    <td style="font-size:0.85rem;">{{ $position->domicile ?? 'N/A' }}</td>
                    <td><span class="fw-bold" style="color:var(--orange-gold);">Rs. {{ number_format($position->fee_amount) }}</span></td>
                    <td>
                        <a href="{{ route('admin.applications') }}?position_id={{ $position->id }}" class="badge" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);text-decoration:none;">
                            {{ $position->applications()->count() }}
                        </a>
                    </td>
                    <td>
                        @if($position->is_active)
                            <span class="badge-custom badge-approved"><i class="fas fa-circle me-1" style="font-size:0.5rem;"></i>Active</span>
                        @else
                            <span class="badge-custom badge-rejected"><i class="fas fa-circle me-1" style="font-size:0.5rem;"></i>Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.positions.edit', $position->id) }}" class="btn btn-sm action-btn" style="background:var(--royal-blue);color:white;" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.positions.toggle', $position->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm action-btn" style="background:{{ $position->is_active ? 'rgba(245,158,11,0.15)' : 'rgba(16,185,129,0.15)' }};color:{{ $position->is_active ? '#D97706' : '#059669' }};" title="{{ $position->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="fas fa-{{ $position->is_active ? 'eye-slash' : 'eye' }}"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.positions.destroy', $position->id) }}" class="d-inline" onsubmit="return confirm('Delete this position?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm action-btn" style="background:rgba(239,68,68,0.15);color:#DC2626;" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center py-5 text-muted">
                        <i class="fas fa-briefcase fs-1" style="color:var(--gray-light);"></i>
                        <p class="mt-2 mb-0">No positions found. <a href="{{ route('admin.positions.create') }}">Add one</a> or visit <a href="/update-positions">/update-positions</a> to load from advertisement.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
