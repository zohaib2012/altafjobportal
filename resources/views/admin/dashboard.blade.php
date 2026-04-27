@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('header')
<div class="page-header w-100">
    <div>
        <h3 class="page-title mb-1">Dashboard</h3>
        <p class="text-muted mb-0">Welcome back! Here's an overview of all applications.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.export') }}" class="btn btn-primary-custom">
            <i class="fas fa-download me-2"></i> Export CSV
        </a>
    </div>
</div>
@endsection

@section('content')
{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $stats['total'] }}</div>
                    <div class="stat-label">Total</div>
                </div>
                <div class="stat-icon blue"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number" style="color:#F59E0B;">{{ $stats['pending'] }}</div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-icon orange"><i class="fas fa-clock"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number" style="color:#0EA5E9;">{{ $stats['shortlisted'] }}</div>
                    <div class="stat-label">Shortlisted</div>
                </div>
                <div class="stat-icon" style="background:rgba(14,165,233,0.15);color:#0EA5E9;"><i class="fas fa-star"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number" style="color:#10B981;">{{ $stats['approved'] }}</div>
                    <div class="stat-label">Approved</div>
                </div>
                <div class="stat-icon green"><i class="fas fa-check"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number" style="color:#EF4444;">{{ $stats['rejected'] }}</div>
                    <div class="stat-label">Rejected</div>
                </div>
                <div class="stat-icon red"><i class="fas fa-times"></i></div>
            </div>
        </div>
    </div>
</div>

{{-- Charts Row --}}
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="stat-card h-100">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom:1px solid var(--gray-light);padding-bottom:1rem;">
                <div style="width:44px;height:44px;background:linear-gradient(135deg,var(--royal-blue),var(--sky-blue));border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-chart-bar text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Applications per Position</h5>
                    <small class="text-muted">All time breakdown</small>
                </div>
            </div>
            <canvas id="positionChart" height="200"></canvas>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="stat-card h-100">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom:1px solid var(--gray-light);padding-bottom:1rem;">
                <div style="width:44px;height:44px;background:linear-gradient(135deg,var(--green),#059669);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-chart-pie text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Status Breakdown</h5>
                    <small class="text-muted">Current distribution</small>
                </div>
            </div>
            <canvas id="statusChart" height="200"></canvas>
        </div>
    </div>
</div>

{{-- Recent Applications + Activity --}}
<div class="row g-4">
    <div class="col-lg-8">
        <div class="stat-card" style="padding:0;">
            <div class="d-flex justify-content-between align-items-center p-4" style="background:linear-gradient(135deg,var(--primary-navy),var(--primary-blue));color:white;border-radius:16px 16px 0 0;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:44px;height:44px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-history"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Recent Applications</h5>
                        <small style="opacity:0.8;">Latest 10 submissions</small>
                    </div>
                </div>
                <a href="{{ route('admin.applications') }}" class="btn btn-sm" style="background:rgba(255,255,255,0.2);color:white;border-radius:8px;">
                    <i class="fas fa-eye me-1"></i> View All
                </a>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>App ID</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentApps as $app)
                        <tr>
                            <td><span style="font-weight:600;color:var(--royal-blue);">{{ $app->application_id }}</span></td>
                            <td class="fw-medium">{{ $app->full_name }}</td>
                            <td><span class="badge" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);">{{ $app->position->title ?? 'N/A' }}</span></td>
                            <td>
                                @if($app->status=='approved')
                                    <span class="badge-custom badge-approved"><i class="fas fa-check me-1"></i>Approved</span>
                                @elseif($app->status=='rejected')
                                    <span class="badge-custom badge-rejected"><i class="fas fa-times me-1"></i>Rejected</span>
                                @elseif($app->status=='shortlisted')
                                    <span class="badge-custom" style="background:rgba(14,165,233,0.15);color:#0284C7;"><i class="fas fa-star me-1"></i>Shortlisted</span>
                                @else
                                    <span class="badge-custom badge-pending"><i class="fas fa-clock me-1"></i>Pending</span>
                                @endif
                            </td>
                            <td><small class="text-muted">{{ $app->created_at->format('d M Y') }}</small></td>
                            <td>
                                <a href="{{ route('admin.applications.show', $app->id) }}" class="btn btn-sm action-btn" style="background:var(--royal-blue);color:white;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">No applications yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="stat-card mb-4">
            <div class="d-flex align-items-center gap-3 mb-4" style="border-bottom:1px solid var(--gray-light);padding-bottom:1rem;">
                <div style="width:44px;height:44px;background:linear-gradient(135deg,var(--royal-blue),var(--sky-blue));border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-history text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Activity Log</h5>
                    <small class="text-muted">Recent admin actions</small>
                </div>
            </div>
            @if(isset($recentLogs) && $recentLogs->count() > 0)
            <div class="d-flex flex-column gap-2" style="max-height:280px;overflow-y:auto;">
                @foreach($recentLogs as $log)
                <div class="d-flex align-items-start gap-2 p-2" style="background:rgba(59,130,246,0.04);border-radius:8px;">
                    <div style="width:32px;height:32px;background:var(--primary-navy);border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;flex-shrink:0;font-size:0.75rem;">
                        @if($log->action=='login') <i class="fas fa-sign-in-alt"></i>
                        @elseif($log->action=='logout') <i class="fas fa-sign-out-alt"></i>
                        @elseif(str_contains($log->action,'status')) <i class="fas fa-edit"></i>
                        @elseif($log->action=='fee_verification') <i class="fas fa-receipt"></i>
                        @else <i class="fas fa-cog"></i>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold" style="font-size:0.8rem;text-transform:capitalize;">{{ str_replace('_',' ',$log->action) }}</div>
                        <div class="text-muted" style="font-size:0.75rem;">{{ Str::limit($log->description,40) }}</div>
                        <div class="text-muted" style="font-size:0.7rem;">{{ $log->created_at->format('g:i A') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-3"><i class="fas fa-inbox fs-2" style="color:var(--gray-light);"></i><p class="text-muted mt-2 mb-0 small">No activity yet</p></div>
            @endif
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center gap-3 mb-3" style="border-bottom:1px solid var(--gray-light);padding-bottom:1rem;">
                <div style="width:44px;height:44px;background:linear-gradient(135deg,var(--green),#059669);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-bolt text-white"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Quick Actions</h5>
                    <small class="text-muted">Frequently used</small>
                </div>
            </div>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.applications') }}?status=pending" class="btn d-flex align-items-center justify-content-between p-3" style="background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.3);border-radius:10px;color:var(--dark);">
                    <span><i class="fas fa-clock me-2" style="color:#F59E0B;"></i>Pending ({{ $stats['pending'] }})</span>
                    <i class="fas fa-chevron-right text-muted"></i>
                </a>
                <a href="{{ route('admin.applications') }}?status=shortlisted" class="btn d-flex align-items-center justify-content-between p-3" style="background:rgba(14,165,233,0.1);border:1px solid rgba(14,165,233,0.3);border-radius:10px;color:var(--dark);">
                    <span><i class="fas fa-star me-2" style="color:#0EA5E9;"></i>Shortlisted ({{ $stats['shortlisted'] }})</span>
                    <i class="fas fa-chevron-right text-muted"></i>
                </a>
                <a href="{{ route('admin.merit-list') }}" class="btn d-flex align-items-center justify-content-between p-3" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);border-radius:10px;color:var(--dark);">
                    <span><i class="fas fa-trophy me-2" style="color:#10B981;"></i>Merit List</span>
                    <i class="fas fa-chevron-right text-muted"></i>
                </a>
                <a href="{{ route('admin.positions') }}" class="btn d-flex align-items-center justify-content-between p-3" style="background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.3);border-radius:10px;color:var(--dark);">
                    <span><i class="fas fa-briefcase me-2" style="color:var(--royal-blue);"></i>Manage Positions</span>
                    <i class="fas fa-chevron-right text-muted"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
var chartLabels  = @json($chartLabels);
var chartData    = @json($chartData);
var statusLabels = @json($statusLabels);
var statusData   = @json($statusData);

// Applications per position bar chart
new Chart(document.getElementById('positionChart'), {
    type: 'bar',
    data: {
        labels: chartLabels,
        datasets: [{
            label: 'Applications',
            data: chartData,
            backgroundColor: 'rgba(59,130,246,0.7)',
            borderColor: '#3B82F6',
            borderWidth: 2,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { maxRotation: 30, font: { size: 10 } } },
            y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { precision: 0 } }
        }
    }
});

// Status doughnut chart
new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: statusLabels,
        datasets: [{
            data: statusData,
            backgroundColor: ['#F59E0B','#0EA5E9','#10B981','#EF4444'],
            borderWidth: 0,
            hoverOffset: 8,
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: {
            legend: { position: 'bottom', labels: { padding: 16, font: { size: 12 } } }
        }
    }
});
</script>
@endsection
