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
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-0 text-white">Browse Jobs</h3>
            <p style="color:rgba(255,255,255,0.4); margin:0; font-size:0.9rem;">
                Find your perfect opportunity
            </p>
        </div>
        <form method="GET" action="{{ route('jobs.index') }}" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" class="search-box"
                   placeholder="Search jobs..." value="{{ request('search') }}">
            <input type="text" name="location" class="search-box"
                   placeholder="Location..." value="{{ request('location') }}" style="width:140px;">
            <button type="submit"
                    style="background:#7c3aed; color:#fff; border:none;
                           border-radius:10px; padding:8px 20px;
                           font-weight:600; font-size:0.88rem; cursor:pointer;">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>

    {{-- Job Cards --}}
    <div class="row g-4">
        @forelse($jobs as $job)
            <div class="col-md-6 col-xl-4">
                <div class="job-card">

                    {{-- Title + Badge --}}
                    <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                        <h5 class="text-white fw-bold mb-0" style="line-height:1.3;">
                            {{ $job->title }}
                        </h5>
                        <span class="job-type-badge">{{ $job->job_type }}</span>
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
                    <p style="color:rgba(255,255,255,0.35); font-size:0.85rem; margin-top:0.5rem; margin-bottom:0;">
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
                    <i class="bi bi-briefcase" style="font-size:3rem; color:#7c3aed; opacity:0.4;"></i>
                    <p class="text-white fw-bold mt-3 mb-1">No jobs available</p>
                    <p style="color:rgba(255,255,255,0.4); font-size:0.9rem;">
                        Check back soon for new opportunities.
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4" style="color:rgba(255,255,255,0.5);">
        {{ $jobs->links() }}
    </div>

</div>
@endsection