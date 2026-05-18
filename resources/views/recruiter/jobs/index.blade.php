@extends('layouts.app')
@section('title', 'My Jobs')

@push('styles')
<style>
    .job-row {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 14px;
        padding: 18px 20px;
        margin-bottom: 10px;
        transition: border-color 0.2s;
    }
    .job-row:hover {
        border-color: #7c3aed;
    }
    .job-type-badge {
        background: rgba(124,58,237,0.15);
        color: #a78bfa;
        border: 1px solid #7c3aed;
        border-radius: 50px;
        padding: 3px 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .expiry-badge {
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 50px;
        padding: 3px 12px;
        white-space: nowrap;
    }
    .btn-edit {
        background: rgba(124,58,237,0.12);
        border: 1px solid #7c3aed;
        color: #a78bfa;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-edit:hover {
        background: #7c3aed;
        color: #fff;
    }
    .btn-delete {
        background: rgba(239,68,68,0.08);
        border: 1px solid rgba(239,68,68,0.35);
        color: #ef4444;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'Outfit', sans-serif;
    }
    .btn-delete:hover {
        background: rgba(239,68,68,0.18);
    }

    /* Style the Laravel pagination to match dark theme */
    .pagination {
        gap: 4px;
    }
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

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-white">My Jobs</h3>
            <p style="color:rgba(255,255,255,0.4); margin:0; font-size:0.9rem;">
                All job postings you have created
            </p>
        </div>
        <a href="{{ route('recruiter.jobs.create') }}"
           style="background:#7c3aed; color:#fff; border-radius:10px;
                  padding:10px 20px; text-decoration:none;
                  font-size:0.9rem; font-weight:600;">
            <i class="bi bi-plus-lg me-1"></i> Post a Job
        </a>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div style="background:rgba(52,211,153,0.1); border:1px solid rgba(52,211,153,0.3);
                    border-radius:10px; padding:12px 16px; margin-bottom:1rem;
                    color:#34d399; font-size:0.9rem;">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Jobs list --}}
    @forelse($jobs as $job)
        @php
            $daysLeft  = $job->expires_at ? now()->diffInDays($job->expires_at, false) : null;
            $isExpired = $daysLeft !== null && $daysLeft <= 0;
            $isUrgent  = $daysLeft !== null && $daysLeft > 0 && $daysLeft <= 5;
        @endphp

        <div class="job-row">
            <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">

                {{-- Job info --}}
                <div style="flex:1; min-width:0;">
                    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                        <h5 class="text-white fw-bold mb-0" style="font-size:1rem;">
                            {{ $job->title }}
                        </h5>
                        <span class="job-type-badge">{{ $job->job_type }}</span>

                        {{-- Expiry badge --}}
                        @if($job->expires_at)
                            @if($isExpired)
                                <span class="expiry-badge"
                                      style="background:rgba(239,68,68,0.15); color:#ef4444;
                                             border:1px solid rgba(239,68,68,0.3);">
                                    Expired
                                </span>
                            @elseif($isUrgent)
                                <span class="expiry-badge"
                                      style="background:rgba(251,191,36,0.12); color:#fbbf24;
                                             border:1px solid rgba(251,191,36,0.3);">
                                    {{ $daysLeft }}d left
                                </span>
                            @else
                                <span class="expiry-badge"
                                      style="background:rgba(52,211,153,0.1); color:#34d399;
                                             border:1px solid rgba(52,211,153,0.25);">
                                    {{ $daysLeft }}d left
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

                    <p style="color:rgba(255,255,255,0.45); font-size:0.83rem; margin:0;">
                        <i class="bi bi-building me-1"></i>{{ $job->company_name }}
                        <span class="mx-2" style="opacity:0.3;">|</span>
                        <i class="bi bi-geo-alt me-1"></i>{{ $job->location }}
                        @if($job->salary)
                            <span class="mx-2" style="opacity:0.3;">|</span>
                            <i class="bi bi-cash me-1" style="color:#34d399;"></i>
                            <span style="color:#34d399;">{{ $job->salary }}</span>
                        @endif
                        <span class="mx-2" style="opacity:0.3;">|</span>
                        <i class="bi bi-people me-1"></i>
                        {{ $job->applications()->count() }} applicant(s)
                        <span class="mx-2" style="opacity:0.3;">|</span>
                        Posted {{ $job->created_at->diffForHumans() }}
                    </p>
                </div>

                {{-- Action buttons --}}
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ route('recruiter.jobs.edit', $job->id) }}" class="btn-edit">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <form method="POST"
                          action="{{ route('recruiter.jobs.destroy', $job->id) }}"
                          onsubmit="return confirm('Delete this job? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @empty
        <div style="text-align:center; padding:4rem 0;
                    color:rgba(255,255,255,0.25);">
            <i class="bi bi-briefcase" style="font-size:3rem; display:block; margin-bottom:12px;"></i>
            <p style="font-size:0.95rem;">You haven't posted any jobs yet.</p>
            <a href="{{ route('recruiter.jobs.create') }}"
               style="background:#7c3aed; color:#fff; border-radius:50px;
                      padding:8px 24px; text-decoration:none;
                      font-size:0.9rem; font-weight:600;">
                Post your first job →
            </a>
        </div>
    @endforelse

    {{-- Pagination — works because controller uses ->paginate(10) --}}
    @if($jobs->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $jobs->links() }}
        </div>
    @endif

</div>
@endsection