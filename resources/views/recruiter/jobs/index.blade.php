@extends('layouts.app')
@section('title', 'Browse Jobs')

@push('styles')
<style>
    body { background-color: #0d0d1a !important; }
    .job-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 24px;
        transition: all 0.3s;
        height: 100%;
    }
    .job-card:hover {
        border-color: #7c3aed;
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(124,58,237,0.2);
    }
    .job-type-badge {
        background: rgba(124,58,237,0.15);
        color: #a78bfa;
        border: 1px solid #7c3aed;
        border-radius: 50px;
        padding: 3px 14px;
        font-size: 0.78rem;
        font-weight: 600;
    }
    .search-bar {
        background: rgba(255,255,255,0.05);
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 2rem;
    }
    .search-bar input, .search-bar select {
        background: #0d0d1a;
        border: 1px solid #1e1e3a;
        color: #fff;
        border-radius: 10px;
    }
    .search-bar input::placeholder { color: rgba(255,255,255,0.3); }
    .search-bar input:focus, .search-bar select:focus {
        background: #0d0d1a;
        border-color: #7c3aed;
        color: #fff;
        box-shadow: none;
    }
</style>
@endpush

@section('content')
<div class="container py-5">

    {{-- Page Header --}}
    <div class="text-center mb-5">
        <p style="color:#a78bfa; font-size:0.8rem; letter-spacing:3px;
                  text-transform:uppercase; font-weight:600;">
            #Opportunities
        </p>
        <h2 style="color:#fff; font-weight:800; font-size:2.2rem;">Browse All Jobs</h2>
        <p style="color:rgba(255,255,255,0.4);">Find your perfect opportunity</p>
    </div>

    {{-- Search Bar --}}
    <div class="search-bar">
        <form action="{{ route('jobs.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label"
                           style="color:rgba(255,255,255,0.5); font-size:0.85rem;">
                        Keyword
                    </label>
                    <input type="text" name="search" class="form-control"
                           placeholder="Job title or company..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-5">
                    <label class="form-label"
                           style="color:rgba(255,255,255,0.5); font-size:0.85rem;">
                        Location
                    </label>
                    <input type="text" name="location" class="form-control"
                           placeholder="City or country..."
                           value="{{ request('location') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn w-100 py-2"
                            style="background:#7c3aed; color:#fff;
                                   border-radius:10px; font-weight:600;">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Results count --}}
    @if(request('search') || request('location'))
        <p style="color:rgba(255,255,255,0.4); margin-bottom:1.5rem; font-size:0.9rem;">
            Showing {{ $jobs->total() }} result(s)
            @if(request('search')) for "<strong style="color:#a78bfa;">{{ request('search') }}</strong>"@endif
            @if(request('location')) in "<strong style="color:#a78bfa;">{{ request('location') }}</strong>"@endif
        </p>
    @endif

    {{-- Job Cards --}}
    <div class="row g-4">
        @forelse($jobs as $job)
            <div class="col-md-6">
                <div class="job-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="text-white fw-bold mb-0">{{ $job->title }}</h5>
                        <span class="job-type-badge text-capitalize">{{ $job->job_type }}</span>
                    </div>
                    <p style="color:#a78bfa; margin-bottom:6px;">
                        <i class="bi bi-building"></i> {{ $job->company_name }}
                    </p>
                    <p style="color:rgba(255,255,255,0.5); margin-bottom:6px; font-size:0.9rem;">
                        <i class="bi bi-geo-alt"></i> {{ $job->location }}
                    </p>
                    @if($job->salary)
                        <p style="color:#34d399; font-size:0.9rem; margin-bottom:10px;">
                            <i class="bi bi-cash"></i> {{ $job->salary }}
                        </p>
                    @endif
                    <p style="color:rgba(255,255,255,0.4); font-size:0.85rem;">
                        {{ Str::limit($job->description, 100) }}
                    </p>
                    <a href="{{ route('jobs.show', $job->id) }}"
                       class="btn btn-sm mt-2 w-100"
                       style="background:rgba(124,58,237,0.15);
                              border:1px solid #7c3aed;
                              color:#a78bfa; border-radius:8px;">
                        View & Apply →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-search" style="font-size:3rem; color:rgba(255,255,255,0.2);"></i>
                <p style="color:rgba(255,255,255,0.4); margin-top:1rem;">
                    No jobs found matching your search.
                </p>
                <a href="{{ route('jobs.index') }}"
                   class="btn mt-2"
                   style="background:#7c3aed; color:#fff; border-radius:50px;">
                    Clear Search
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-5 d-flex justify-content-center">
        {{ $jobs->links() }}
    </div>

</div>
@endsection