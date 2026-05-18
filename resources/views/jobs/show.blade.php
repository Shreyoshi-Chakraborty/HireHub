@extends('layouts.app')
@section('title', $job->title)

@push('styles')
<style>
    .job-detail-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 20px;
        padding: 2.5rem;
    }
    .job-type-badge {
        background: rgba(124,58,237,0.15);
        color: #a78bfa;
        border: 1px solid #7c3aed;
        border-radius: 50px;
        padding: 4px 18px;
        font-size: 0.82rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .meta-row {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
        margin-bottom: 8px;
    }
    .meta-row i { color: #7c3aed; }
    .salary-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(52,211,153,0.1);
        border: 1px solid rgba(52,211,153,0.3);
        color: #34d399;
        border-radius: 10px;
        padding: 8px 18px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    .description-box {
        background: #0d0d1a;
        border: 1px solid #1e1e3a;
        border-radius: 12px;
        padding: 1.5rem;
        color: rgba(255,255,255,0.65);
        font-size: 0.95rem;
        line-height: 1.9;
        white-space: pre-line;
    }
    .applied-banner {
        background: rgba(52,211,153,0.08);
        border: 1px solid rgba(52,211,153,0.3);
        border-radius: 12px;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #34d399;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }
    .btn-apply {
        width: 100%;
        padding: 14px;
        background: #7c3aed;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-family: 'Outfit', sans-serif;
    }
    .btn-apply:hover { background: #5b21b6; }
    .btn-withdraw {
        width: 100%;
        padding: 12px;
        background: transparent;
        color: #ef4444;
        border: 1px solid rgba(239,68,68,0.4);
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-family: 'Outfit', sans-serif;
        margin-top: 0.75rem;
    }
    .btn-withdraw:hover { background: rgba(239,68,68,0.1); }
    .btn-back {
        width: 100%;
        padding: 12px;
        background: transparent;
        color: #a78bfa;
        border: 1px solid #1e1e3a;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        margin-top: 0.75rem;
    }
    .btn-back:hover {
        border-color: #7c3aed;
        color: #fff;
        background: rgba(124,58,237,0.1);
    }
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="job-detail-card">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-start gap-3 mb-4 flex-wrap">
                    <div>
                        <h2 class="text-white fw-bold mb-2">{{ $job->title }}</h2>
                        <div class="meta-row">
                            <i class="bi bi-building"></i>
                            <span style="color:rgba(255,255,255,0.7);">{{ $job->company_name }}</span>
                        </div>
                        <div class="meta-row">
                            <i class="bi bi-geo-alt"></i> {{ $job->location }}
                        </div>
                        <div class="meta-row">
                            <i class="bi bi-briefcase"></i> {{ ucfirst($job->job_type) }}
                        </div>
                    </div>
                    <span class="job-type-badge">{{ $job->job_type }}</span>
                </div>

                {{-- Salary --}}
                @if($job->salary)
                    <div class="salary-pill">
                        <i class="bi bi-cash-coin"></i> Salary: {{ $job->salary }}
                    </div>
                @endif

                {{-- Description --}}
                <h5 class="text-white fw-bold mb-3">
                    <i class="bi bi-file-text me-2" style="color:#7c3aed;"></i>Job Description
                </h5>
                <div class="description-box mb-4">{{ $job->description }}</div>

                <hr style="border-color:#1e1e3a; margin:1.5rem 0;">

                {{-- Action Buttons --}}
                @auth
                    @if(Auth::user()->role === 'candidate')

                        @if($hasApplied)
                            {{-- Already applied banner --}}
                            <div class="applied-banner">
                                <i class="bi bi-patch-check-fill" style="font-size:1.3rem;"></i>
                                You have already applied for this job
                                @if($application)
                                    &nbsp;·&nbsp;
                                    <span style="color:rgba(52,211,153,0.7); font-size:0.82rem; font-weight:500;">
                                        Applied {{ $application->created_at->format('M d, Y') }}
                                    </span>
                                @endif
                            </div>

                            {{-- Withdraw button --}}
                            @if($application)
                                <form method="POST"
                                      action="{{ route('candidate.applications.withdraw', $application->id) }}"
                                      onsubmit="return confirm('Are you sure you want to withdraw this application?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-withdraw">
                                        <i class="bi bi-x-circle"></i> Withdraw Application
                                    </button>
                                </form>
                            @endif

                        @else
                            {{-- Apply button --}}
                            <form method="POST" action="{{ route('candidate.apply', $job->id) }}">
                                @csrf
                                <button type="submit" class="btn-apply">
                                    <i class="bi bi-send"></i> Apply Now
                                </button>
                            </form>
                        @endif

                        {{-- Back to Dashboard --}}
                        <a href="{{ route('candidate.dashboard') }}" class="btn-back">
                            <i class="bi bi-speedometer2"></i> Back to Dashboard
                        </a>

                    @elseif(Auth::user()->role === 'recruiter')
                        <div style="background:rgba(251,191,36,0.08); border:1px solid rgba(251,191,36,0.3);
                                    border-radius:12px; padding:14px 20px; color:#fbbf24;
                                    font-size:0.9rem; text-align:center;">
                            <i class="bi bi-info-circle me-2"></i> Recruiters cannot apply for jobs.
                        </div>
                        <a href="{{ route('recruiter.dashboard') }}" class="btn-back">
                            <i class="bi bi-speedometer2"></i> Back to Dashboard
                        </a>
                    @endif

                @else
                    <div style="background:rgba(124,58,237,0.08); border:1px solid rgba(124,58,237,0.3);
                                border-radius:12px; padding:18px; text-align:center; color:rgba(255,255,255,0.6);">
                        <i class="bi bi-lock me-2" style="color:#a78bfa;"></i>
                        <a href="{{ route('login') }}" style="color:#a78bfa; font-weight:600;">Login</a>
                        or
                        <a href="{{ route('register') }}" style="color:#a78bfa; font-weight:600;">Register</a>
                        to apply for this job.
                    </div>
                @endauth

            </div>

        </div>
    </div>
</div>
@endsection