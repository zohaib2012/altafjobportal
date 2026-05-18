@extends('admin.layouts.main')

@section('title', 'Marketing Messages')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h3 class="page-title mb-1">Marketing Messages</h3>
        <p class="text-muted mb-0">Home page pe display hone wale messages manage karein</p>
    </div>
</div>

@if(session('success'))
<div class="alert d-flex align-items-center gap-2 mb-4" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);border-radius:12px;padding:1rem 1.25rem;">
    <i class="fas fa-check-circle text-success"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

{{-- Add Message Form --}}
<div class="card mb-4" style="border-radius:16px;border:1px solid var(--gray-light);box-shadow:var(--shadow-md);">
    <div class="card-header fw-bold" style="background:linear-gradient(135deg,var(--primary-navy),var(--primary-blue));color:white;border-radius:16px 16px 0 0;padding:1rem 1.5rem;">
        <i class="fas fa-plus-circle me-2"></i> Naya Message Add Karein
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.marketing.store') }}">
            @csrf
            @if($errors->any())
            <div class="alert mb-3" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:0.75rem;color:#dc2626;">
                {{ $errors->first() }}
            </div>
            @endif
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Title / Heading <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Last date extended till 30 May" value="{{ old('title') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" required>
                        <option value="announcement" {{ old('type')=='announcement'?'selected':'' }}>📢 Announcement (Blue)</option>
                        <option value="warning"      {{ old('type')=='warning'?'selected':'' }}>⚠️ Warning (Orange)</option>
                        <option value="success"      {{ old('type')=='success'?'selected':'' }}>✅ Success (Green)</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                    <textarea name="message" class="form-control" rows="3" placeholder="Poora message yahan likhein jo home page pe dikhana hai..." required>{{ old('message') }}</textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary-custom px-4">
                        <i class="fas fa-paper-plane me-2"></i> Add Message
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Messages List --}}
<div class="card" style="border-radius:16px;border:1px solid var(--gray-light);box-shadow:var(--shadow-md);">
    <div class="card-header fw-bold" style="background:var(--white);border-bottom:1px solid var(--gray-light);border-radius:16px 16px 0 0;padding:1rem 1.5rem;">
        <i class="fas fa-list me-2" style="color:var(--royal-blue);"></i> Sare Messages
        <span class="badge ms-2" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);">{{ $messages->count() }}</span>
    </div>
    <div class="card-body p-0">
        @forelse($messages as $msg)
        @php
            $colors = [
                'announcement' => ['bg'=>'rgba(59,130,246,0.08)','border'=>'rgba(59,130,246,0.3)','icon'=>'fas fa-bullhorn','color'=>'var(--royal-blue)'],
                'warning'      => ['bg'=>'rgba(245,158,11,0.08)','border'=>'rgba(245,158,11,0.3)','icon'=>'fas fa-exclamation-triangle','color'=>'#D97706'],
                'success'      => ['bg'=>'rgba(16,185,129,0.08)','border'=>'rgba(16,185,129,0.3)','icon'=>'fas fa-check-circle','color'=>'#059669'],
            ];
            $c = $colors[$msg->type] ?? $colors['announcement'];
        @endphp
        <div class="p-4" style="border-bottom:1px solid var(--gray-light);{{ !$msg->is_active ? 'opacity:0.5;' : '' }}">
            <div class="d-flex align-items-start justify-content-between gap-3">
                <div class="flex-grow-1">
                    {{-- Preview --}}
                    <div class="p-3 mb-2" style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};border-radius:10px;">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="{{ $c['icon'] }}" style="color:{{ $c['color'] }};"></i>
                            <strong style="color:{{ $c['color'] }};">{{ $msg->title }}</strong>
                            @if(!$msg->is_active)
                                <span class="badge bg-secondary ms-1" style="font-size:0.7rem;">Hidden</span>
                            @else
                                <span class="badge bg-success ms-1" style="font-size:0.7rem;">Live</span>
                            @endif
                        </div>
                        <p class="mb-0 text-muted" style="font-size:0.9rem;">{{ $msg->message }}</p>
                    </div>
                    <small class="text-muted">Added: {{ $msg->created_at->format('d M Y, h:i A') }}</small>
                </div>
                <div class="d-flex gap-2 flex-shrink-0">
                    {{-- Toggle --}}
                    <form method="POST" action="{{ route('admin.marketing.toggle', $msg->id) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-sm fw-semibold"
                            style="{{ $msg->is_active ? 'background:rgba(245,158,11,0.15);color:#D97706;border:1px solid rgba(245,158,11,0.4);' : 'background:rgba(16,185,129,0.15);color:#059669;border:1px solid rgba(16,185,129,0.4);' }} border-radius:8px;padding:0.35rem 0.75rem;">
                            <i class="fas {{ $msg->is_active ? 'fa-eye-slash' : 'fa-eye' }} me-1"></i>
                            {{ $msg->is_active ? 'Hide' : 'Show' }}
                        </button>
                    </form>
                    {{-- Delete --}}
                    <form method="POST" action="{{ route('admin.marketing.destroy', $msg->id) }}"
                          onsubmit="return confirm('Delete karna chahte hain?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm fw-semibold"
                            style="background:rgba(239,68,68,0.1);color:#DC2626;border:1px solid rgba(239,68,68,0.3);border-radius:8px;padding:0.35rem 0.75rem;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <i class="fas fa-bullhorn fs-2 mb-3 d-block" style="opacity:0.3;"></i>
            Koi message nahi hai. Upar se add karein.
        </div>
        @endforelse
    </div>
</div>
@endsection
