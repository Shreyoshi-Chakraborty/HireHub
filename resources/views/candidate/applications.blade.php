@extends('layouts.app')
@section('title', 'My Applications')

@push('styles')
<style>
    .app-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 24px;
        transition: all 0.3s;
    }
    .app-card:hover {
        border-color: #7c3aed;
        box-shadow: 0 4px 24px rgba(124,58,237,0.15);
    }
    .app-meta {
        color: rgba(255,255,255,0.45);
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .app-meta i { color: #7c3aed; }
    .status-badge {
        border-radius: 50px;
        padding: 4px 16px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: capitalize;
        display: inline-block;
    }
    .view-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid #7c3aed;
        color: #a78bfa;
        background: rgba(124,58,237,0.1);
        margin-top: 0.75rem;
    }
    .view-btn:hover {
        background: #7c3aed;
        color: #fff;
    }
    .find-jobs-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        background: #7c3aed;
        color: #fff;
        border: none;
    }
    .find-jobs-btn:hover {
        background: #5b21b6;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-0 text-white">My Applications</h3>
            <p style="color:rgba(255,255,255,0.4); margin:0; font-size:0.9rem;">
                Track the status of your job applications
            </p>
        </div>
        <a href="{{ route('jobs.index') }}" class="find-jobs-btn">
            <i class="bi bi-search"></i> Find More Jobs
        </a>
    </div>

    {{-- Application Cards --}}
    <div class="d-flex flex-column gap-3">
        @forelse($applications as $application)
            <div class="app-card d-flex justify-content-between align-items-center flex-wrap gap-3">

                {{-- Left: Job Info --}}
                <div>
                    <h5 class="text-white fw-bold mb-2">{{ $application->job->title }}</h5>
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <span class="app-meta">
                            <i class="bi bi-building"></i>
                            <span style="color:rgba(255,255,255,0.6);">{{ $application->job->company_name }}</span>
                        </span>
                        <span class="app-meta">
                            <i class="bi bi-geo-alt"></i> {{ $application->job->location }}
                        </span>
                    </div>
                    <span class="app-meta">
                        <i class="bi bi-calendar3"></i>
                        Applied: {{ $application->created_at->format('M d, Y') }}
                    </span>
                </div>

                {{-- Right: Status + Button --}}
                <div class="text-end d-flex flex-column align-items-end">
                    @php
                        [$bg, $color, $border] = match($application->status) {
                            'pending'  => ['rgba(251,191,36,0.15)',  '#fbbf24', '#fbbf24'],
                            'reviewed' => ['rgba(96,165,250,0.15)',  '#60a5fa', '#60a5fa'],
                            'accepted' => ['rgba(52,211,153,0.15)',  '#34d399', '#34d399'],
                            'rejected' => ['rgba(239,68,68,0.15)',   '#ef4444', '#ef4444'],
                            default    => ['rgba(156,163,175,0.15)', '#9ca3af', '#9ca3af'],
                        };
                    @endphp
                    <span class="status-badge"
                          style="background:{{ $bg }}; color:{{ $color }}; border:1px solid {{ $border }};">
                        {{ $application->status }}
                    </span>
                    <a href="{{ route('jobs.show', $application->job->id) }}" class="view-btn">
                        <i class="bi bi-arrow-right-circle"></i> View Job
                    </a>
                </div>

            </div>
        @empty
            <div style="background:#13132a; border:1px solid #1e1e3a;
                        border-radius:16px; padding:60px; text-align:center;">
                <i class="bi bi-inbox" style="font-size:3rem; color:#7c3aed; opacity:0.4;"></i>
                <p class="text-white fw-bold mt-3 mb-1">No applications yet</p>
                <p style="color:rgba(255,255,255,0.4); font-size:0.9rem; margin-bottom:1.5rem;">
                    You haven't applied to any jobs yet.
                </p>
                <a href="{{ route('jobs.index') }}" class="find-jobs-btn">
                    <i class="bi bi-search"></i> Browse Jobs Now
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection