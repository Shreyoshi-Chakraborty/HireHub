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
                Welcome back, {{ $user->name }}! 👋
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

        {{-- Total Jobs --}}
        <div class="col-md-4">
            <div class="dash-card">
                <div class="icon-box"
                     style="background:rgba(124,58,237,0.15);">
                    <i class="bi bi-briefcase-fill"
                       style="color:#a78bfa;"></i>
                </div>
                <div class="stat-number">{{ $totalJobs }}</div>
                <div class="stat-label">Jobs Posted</div>
                <a href="{{ route('recruiter.jobs.index') }}" class="action-btn">
                    <i class="bi bi-list-ul"></i> View My Jobs
                </a>
            </div>
        </div>

        {{-- Total Applicants --}}
        <div class="col-md-4">
            <div class="dash-card">
                <div class="icon-box"
                     style="background:rgba(52,211,153,0.1);">
                    <i class="bi bi-people-fill"
                       style="color:#34d399;"></i>
                </div>
                <div class="stat-number">{{ $totalApplicants }}</div>
                <div class="stat-label">Total Applicants</div>
                <a href="{{ route('recruiter.applicants') }}" class="action-btn"
                   style="border-color:#34d399; color:#34d399;
                          background:rgba(52,211,153,0.08);">
                    <i class="bi bi-eye"></i> View Applicants
                </a>
            </div>
        </div>

        {{-- Quick Action --}}
        <div class="col-md-4">
            <div class="dash-card">
                <div class="icon-box"
                     style="background:rgba(251,191,36,0.1);">
                    <i class="bi bi-plus-circle-fill"
                       style="color:#fbbf24;"></i>
                </div>
                <div class="stat-number">
                    <i class="bi bi-lightning-charge-fill"
                       style="color:#fbbf24; font-size:1.8rem;"></i>
                </div>
                <div class="stat-label">Quick Action</div>
                <a href="{{ route('recruiter.jobs.create') }}" class="action-btn"
                   style="border-color:#fbbf24; color:#fbbf24;
                          background:rgba(251,191,36,0.08);">
                    <i class="bi bi-plus-lg"></i> Post a New Job
                </a>
            </div>
        </div>

    </div>

    {{-- Bottom Row --}}
    <div class="row g-4">

        {{-- Manage Jobs --}}
        <div class="col-md-6">
            <div class="dash-card">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="icon-box mb-0"
                         style="background:rgba(124,58,237,0.15);">
                        <i class="bi bi-briefcase"
                           style="color:#a78bfa;"></i>
                    </div>
                    <div>
                        <h5 class="text-white fw-bold mb-0">Manage Jobs</h5>
                        <p style="color:rgba(255,255,255,0.4);
                                  font-size:0.83rem; margin:0;">
                            View, edit or delete your postings
                        </p>
                    </div>
                </div>
                <a href="{{ route('recruiter.jobs.index') }}" class="action-btn">
                    <i class="bi bi-list-ul"></i> View My Jobs
                </a>
            </div>
        </div>

        {{-- View Applicants --}}
        <div class="col-md-6">
            <div class="dash-card">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="icon-box mb-0"
                         style="background:rgba(52,211,153,0.1);">
                        <i class="bi bi-people"
                           style="color:#34d399;"></i>
                    </div>
                    <div>
                        <h5 class="text-white fw-bold mb-0">View Applicants</h5>
                        <p style="color:rgba(255,255,255,0.4);
                                  font-size:0.83rem; margin:0;">
                            See candidates who applied to your jobs
                        </p>
                    </div>
                </div>
                <a href="{{ route('recruiter.applicants') }}" class="action-btn"
                   style="border-color:#34d399; color:#34d399;
                          background:rgba(52,211,153,0.08);">
                    <i class="bi bi-eye"></i> View Applicants
                </a>
            </div>
        </div>

    </div>

</div>
@endsection