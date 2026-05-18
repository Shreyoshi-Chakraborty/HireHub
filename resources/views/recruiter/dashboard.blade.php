@extends('layouts.app')
@section('title', 'Recruiter Dashboard')

@push('styles')
<style>
    .dash-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        transition: all 0.3s;
    }
    .dash-card:hover {
        border-color: #7c3aed;
        box-shadow: 0 4px 24px rgba(124,58,237,0.15);
    }
    .icon-box {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }
    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1;
        margin-bottom: 4px;
    }
    .stat-label {
        color: rgba(255,255,255,0.4);
        font-size: 0.85rem;
        font-weight: 500;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid #7c3aed;
        color: #a78bfa;
        background: rgba(124,58,237,0.1);
        width: 100%;
        justify-content: center;
        margin-top: 1rem;
    }
    .action-btn:hover {
        background: #7c3aed;
        color: #fff;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #3b0f8c 0%, #7c3aed 100%);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        overflow: hidden;
        position: relative;
    }
    .welcome-banner::before {
        content: '';
        position: absolute;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        top: -60px; right: 60px;
    }
    .welcome-banner::after {
        content: '';
        position: absolute;
        width: 120px; height: 120px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        bottom: -40px; right: 180px;
    }
    .expiry-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px;
        background: #0d0d1a;
        border: 1px solid #1e1e3a;
        border-radius: 10px;
        margin-bottom: 8px;
    }
    .expiry-row:last-child { margin-bottom: 0; }
    .expiry-title {
        font-size: 0.88rem;
        font-weight: 600;
        color: rgba(255,255,255,0.8);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 55%;
    }
    .expiry-badge {
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 50px;
        padding: 3px 12px;
        white-space: nowrap;
    }
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">

    {{-- Welcome Banner --}}
    <div class="welcome-banner">
        <div style="position:relative; z-index:1;">
            <p style="color:rgba(255,255,255,0.6); font-size:0.85rem;
                      margin-bottom:4px; letter-spacing:1px;">
                RECRUITER DASHBOARD
            </p>
            <h3 class="text-white fw-bold mb-1" style="font-size:1.6rem;">
                Welcome back, {{ $user->name }}! 
            </h3>
            <p style="color:rgba(255,255,255,0.6); margin:0; font-size:0.9rem;">
                Manage your job postings and find the best talent.
            </p>
        </div>
        <i class="bi bi-building"
           style="font-size:5rem; color:rgba(255,255,255,0.1);
                  position:relative; z-index:1;"></i>
    </div>

    {{-- Stats Row --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="dash-card">
                <div class="icon-box" style="background:rgba(124,58,237,0.15);">
                    <i class="bi bi-briefcase-fill" style="color:#a78bfa;"></i>
                </div>
                <div class="stat-number">{{ $totalJobs }}</div>
                <div class="stat-label">Jobs Posted</div>
                <a href="{{ route('recruiter.jobs.index') }}" class="action-btn">
                    <i class="bi bi-list-ul"></i> View My Jobs
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dash-card">
                <div class="icon-box" style="background:rgba(52,211,153,0.1);">
                    <i class="bi bi-people-fill" style="color:#34d399;"></i>
                </div>
                <div class="stat-number">{{ $totalApplicants }}</div>
                <div class="stat-label">Total Applicants</div>
                <a href="{{ route('recruiter.applicants') }}" class="action-btn"
                   style="border-color:#34d399; color:#34d399; background:rgba(52,211,153,0.08);">
                    <i class="bi bi-eye"></i> View Applicants
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dash-card">
                <div class="icon-box" style="background:rgba(251,191,36,0.1);">
                    <i class="bi bi-plus-circle-fill" style="color:#fbbf24;"></i>
                </div>
                <div class="stat-number">
                    <i class="bi bi-lightning-charge-fill"
                       style="color:#fbbf24; font-size:1.8rem;"></i>
                </div>
                <div class="stat-label">Quick Action</div>
                <a href="{{ route('recruiter.jobs.create') }}" class="action-btn"
                   style="border-color:#fbbf24; color:#fbbf24; background:rgba(251,191,36,0.08);">
                    <i class="bi bi-plus-lg"></i> Post a New Job
                </a>
            </div>
        </div>

    </div>

    {{-- Bottom Row --}}
    <div class="row g-4">

        {{-- Active Job Listings --}}
        <div class="col-md-8">
            <div class="dash-card" style="height:auto;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-box mb-0"
                             style="background:rgba(124,58,237,0.15); flex-shrink:0;">
                            <i class="bi bi-clock-history" style="color:#a78bfa;"></i>
                        </div>
                        <div>
                            <h5 class="text-white fw-bold mb-0">Active Job Listings</h5>
                            <p style="color:rgba(255,255,255,0.4); font-size:0.83rem; margin:0;">
                                Validity &amp; expiry at a glance
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('recruiter.jobs.index') }}"
                       style="font-size:0.8rem; color:#a78bfa; text-decoration:none; font-weight:600;">
                        View all <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                @forelse($recentJobs as $job)
                    @php
                        $daysLeft  = $job->expires_at ? now()->diffInDays($job->expires_at, false) : null;
                        $isExpired = $daysLeft !== null && $daysLeft <= 0;
                        $isUrgent  = $daysLeft !== null && $daysLeft > 0 && $daysLeft <= 5;
                    @endphp
                    <div class="expiry-row">
                        <div>
                            <div class="expiry-title">{{ $job->title }}</div>
                            <div style="font-size:0.75rem; color:rgba(255,255,255,0.35); margin-top:2px;">
                                {{ $job->company_name }} · {{ $job->job_type }}
                            </div>
                        </div>
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
                @empty
                    <div style="text-align:center; padding:2rem 0;
                                color:rgba(255,255,255,0.25); font-size:0.9rem;">
                        <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:8px;"></i>
                        No jobs yet.
                        <a href="{{ route('recruiter.jobs.create') }}"
                           style="color:#a78bfa; display:block; margin-top:6px; font-weight:600;">
                            Post your first job →
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Quick Stats — NO "Post a New Job" button here --}}
        <div class="col-md-4">
            <div class="dash-card" style="height:auto;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="icon-box mb-0"
                         style="background:rgba(251,191,36,0.1); flex-shrink:0;">
                        <i class="bi bi-bar-chart-fill" style="color:#fbbf24;"></i>
                    </div>
                    <div>
                        <h5 class="text-white fw-bold mb-0">Quick Stats</h5>
                        <p style="color:rgba(255,255,255,0.4); font-size:0.83rem; margin:0;">
                            Your hiring snapshot
                        </p>
                    </div>
                </div>

                <div style="display:flex; flex-direction:column; gap:10px;">
                    <div style="background:#0d0d1a; border:1px solid #1e1e3a;
                                border-radius:10px; padding:12px 16px;
                                display:flex; justify-content:space-between; align-items:center;">
                        <span style="color:rgba(255,255,255,0.55); font-size:0.85rem;">Active Jobs</span>
                        <span style="color:#a78bfa; font-weight:800; font-size:1.1rem;">
                            {{ $activeJobs }}
                        </span>
                    </div>
                    <div style="background:#0d0d1a; border:1px solid #1e1e3a;
                                border-radius:10px; padding:12px 16px;
                                display:flex; justify-content:space-between; align-items:center;">
                        <span style="color:rgba(255,255,255,0.55); font-size:0.85rem;">Total Applicants</span>
                        <span style="color:#34d399; font-weight:800; font-size:1.1rem;">
                            {{ $totalApplicants }}
                        </span>
                    </div>
                    <div style="background:#0d0d1a; border:1px solid #1e1e3a;
                                border-radius:10px; padding:12px 16px;
                                display:flex; justify-content:space-between; align-items:center;">
                        <span style="color:rgba(255,255,255,0.55); font-size:0.85rem;">Expiring Soon</span>
                        <span style="color:#fbbf24; font-weight:800; font-size:1.1rem;">
                            {{ $expiringSoon }}
                        </span>
                    </div>
                    <div style="background:#0d0d1a; border:1px solid #1e1e3a;
                                border-radius:10px; padding:12px 16px;
                                display:flex; justify-content:space-between; align-items:center;">
                        <span style="color:rgba(255,255,255,0.55); font-size:0.85rem;">Expired Jobs</span>
                        <span style="color:#ef4444; font-weight:800; font-size:1.1rem;">
                            {{ $expiredJobs }}
                        </span>
                    </div>
                </div>
                {{-- NO Post a New Job button here --}}
            </div>
        </div>

    </div>

</div>
@endsection