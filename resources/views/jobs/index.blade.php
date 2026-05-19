@extends('layouts.app')
@section('title', 'Browse Jobs')

@push('styles')
<style>
    .job-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        transition: all 0.3s;
    }
    .job-card:hover {
        border-color: #7c3aed;
        box-shadow: 0 4px 24px rgba(124,58,237,0.15);
        transform: translateY(-2px);
    }
    .job-type-badge {
        background: rgba(124,58,237,0.15);
        color: #a78bfa;
        border: 1px solid #7c3aed;
        border-radius: 50px;
        padding: 3px 14px;
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: capitalize;
        white-space: nowrap;
    }
    .expiry-badge {
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 50px;
        padding: 3px 12px;
        white-space: nowrap;
    }
    .job-meta {
        color: rgba(255,255,255,0.45);
        font-size: 0.88rem;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .job-meta i { color: #7c3aed; }
    .job-salary {
        color: #34d399;
        font-size: 0.88rem;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .apply-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid #7c3aed;
        color: #a78bfa;
        background: rgba(124,58,237,0.1);
        margin-top: 1rem;
    }
    .apply-btn:hover {
        background: #7c3aed;
        color: #fff;
    }
    .search-box {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 12px;
        padding: 8px 16px;
        color: #fff;
        font-size: 0.9rem;
        outline: none;
        transition: border-color 0.2s;
    }
    .search-box::placeholder { color: rgba(255,255,255,0.3); }
    .search-box:focus { border-color: #7c3aed; }
    .pagination { gap: 4px; }
    .page-link {
        background: #13132a;
        border: 1px solid #1e1e3a;
        color: #a78bfa;
        border-radius: 8px !important;
        padding: 6px 14px;
        font-size: 0.85rem;
    }
    .page-link:hover {
        background: #7c3aed;
        border-color: #7c3aed;
        color: #fff;
    }
    .page-item.active .page-link {
        background: #7c3aed;
        border-color: #7c3aed;
        color: #fff;
    }
    .page-item.disabled .page-link {
        background: #0d0d1a;
        color: rgba(255,255,255,0.2);
    }
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-0 text-white">Browse Jobs</h3>
            <p style="color:rgba(255,255,255,0.4); margin:0; font-size:0.9rem;">
                {{ $jobs->total() }} job{{ $jobs->total() !== 1 ? 's' : '' }} available
                @if(request('search') || request('location'))
                    — filtered by
                    @if(request('search'))<strong style="color:#a78bfa;">{{ request('search') }}</strong>@endif
                    @if(request('location')) in <strong style="color:#a78bfa;">{{ request('location') }}</strong>@endif
                @endif
            </p>
        </div>
        <form method="GET" action="{{ route('jobs.index') }}" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" class="search-box"
                   placeholder="Search jobs..." value="{{ request('search') }}">
            <input type="text" name="location" class="search-box"
                   placeholder="Location..." value="{{ request('location') }}"
                   style="width:140px;">
            <button type="submit"
                    style="background:#7c3aed; color:#fff; border:none;
                           border-radius:10px; padding:8px 20px;
                           font-weight:600; font-size:0.88rem; cursor:pointer;">
                <i class="bi bi-search"></i> Search
            </button>
            @if(request('search') || request('location'))
                <a href="{{ route('jobs.index') }}"
                   style="background:transparent; border:1px solid #1e1e3a;
                          color:rgba(255,255,255,0.4); border-radius:10px;
                          padding:8px 16px; font-size:0.88rem; font-weight:600;
                          text-decoration:none; display:inline-flex;
                          align-items:center; gap:4px; transition:all 0.2s;"
                   onmouseover="this.style.borderColor='#ef4444'; this.style.color='#ef4444'"
                   onmouseout="this.style.borderColor='#1e1e3a'; this.style.color='rgba(255,255,255,0.4)'">
                    <i class="bi bi-x"></i> Clear
                </a>
            @endif
        </form>
    </div>

    {{-- Job Cards --}}
    <div class="row g-4">
        @forelse($jobs as $job)
            @php
                $daysLeft = $job->expires_at
                                ? (int) now()->diffInDays($job->expires_at, false)
                                : null;
                $isUrgent = $daysLeft !== null && $daysLeft <= 5;
            @endphp
            <div class="col-md-6 col-xl-4">
                <div class="job-card">

                    {{-- Title + Badges --}}
                    <div class="d-flex justify-content-between align-items-start gap-2 mb-3 flex-wrap">
                        <h5 class="text-white fw-bold mb-0" style="line-height:1.3;">
                            {{ $job->title }}
                        </h5>
                        <div class="d-flex gap-1 flex-wrap">
                            <span class="job-type-badge">{{ $job->job_type }}</span>
                            @if($daysLeft !== null)
                                @if($isUrgent)
                                    <span class="expiry-badge"
                                          style="background:rgba(251,191,36,0.12); color:#fbbf24;
                                                 border:1px solid rgba(251,191,36,0.3);">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $daysLeft }}d left
                                    </span>
                                @else
                                    <span class="expiry-badge"
                                          style="background:rgba(52,211,153,0.1); color:#34d399;
                                                 border:1px solid rgba(52,211,153,0.25);">
                                        <i class="bi bi-clock me-1"></i>{{ $daysLeft }}d left
                                    </span>
                                @endif
                            @else
                                <span class="expiry-badge"
                                      style="background:rgba(124,58,237,0.12); color:#a78bfa;
                                             border:1px solid rgba(124,58,237,0.3);">
                                    No expiry
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Meta --}}
                    <p class="job-meta">
                        <i class="bi bi-building"></i>
                        <span style="color:rgba(255,255,255,0.6);">{{ $job->company_name }}</span>
                    </p>
                    <p class="job-meta">
                        <i class="bi bi-geo-alt"></i> {{ $job->location }}
                    </p>
                    @if($job->salary)
                        <p class="job-salary">
                            <i class="bi bi-cash" style="color:#34d399;"></i> {{ $job->salary }}
                        </p>
                    @endif

                    {{-- Description snippet --}}
                    <p style="color:rgba(255,255,255,0.35); font-size:0.85rem;
                              margin-top:0.5rem; margin-bottom:0; line-height:1.6;">
                        {{ Str::limit($job->description, 90) }}
                    </p>

                    {{-- CTA --}}
                    <a href="{{ route('jobs.show', $job->id) }}" class="apply-btn">
                        <i class="bi bi-arrow-right-circle"></i> View & Apply
                    </a>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div style="background:#13132a; border:1px solid #1e1e3a;
                            border-radius:16px; padding:48px; text-align:center;">
                    <i class="bi bi-briefcase"
                       style="font-size:3rem; color:#7c3aed; opacity:0.4;"></i>
                    <p class="text-white fw-bold mt-3 mb-1">No jobs found</p>
                    <p style="color:rgba(255,255,255,0.4); font-size:0.9rem;">
                        @if(request('search') || request('location'))
                            Try different search terms or
                            <a href="{{ route('jobs.index') }}"
                               style="color:#a78bfa; font-weight:600;">
                                clear filters
                            </a>
                        @else
                            Check back soon for new opportunities.
                        @endif
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($jobs->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $jobs->links() }}
        </div>
    @endif

</div>
@endsection