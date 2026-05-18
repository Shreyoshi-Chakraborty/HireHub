@extends('layouts.app')
@section('title', 'Candidate Dashboard')

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
    .profile-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 24px;
    }
    .profile-field {
        background: #0d0d1a;
        border: 1px solid #1e1e3a;
        border-radius: 10px;
        padding: 10px 16px;
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
    }
    .profile-label {
        color: rgba(255,255,255,0.35);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-bottom: 5px;
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
                CANDIDATE DASHBOARD
            </p>
            <h3 class="text-white fw-bold mb-1" style="font-size:1.6rem;">
                Welcome back, {{ $user->name }}! 
            </h3>
            <p style="color:rgba(255,255,255,0.6); margin:0; font-size:0.9rem;">
                Find your next opportunity and track your applications.
            </p>
        </div>
        <i class="bi bi-person-circle"
           style="font-size:5rem; color:rgba(255,255,255,0.1);
                  position:relative; z-index:1;"></i>
    </div>

    {{-- Stats Row --}}
    <div class="row g-4 mb-4">

        {{-- Applied Jobs --}}
        <div class="col-md-4">
            <div class="dash-card">
                <div class="icon-box"
                     style="background:rgba(124,58,237,0.15);">
                    <i class="bi bi-file-earmark-text-fill"
                       style="color:#a78bfa;"></i>
                </div>
                <div class="stat-number">{{ $appliedCount }}</div>
                <div class="stat-label">Jobs Applied</div>
                <a href="{{ route('candidate.applications') }}" class="action-btn">
                    <i class="bi bi-clock-history"></i> My Applications
                </a>
            </div>
        </div>

        {{-- Browse Jobs --}}
        <div class="col-md-4">
            <div class="dash-card">
                <div class="icon-box"
                     style="background:rgba(52,211,153,0.1);">
                    <i class="bi bi-search"
                       style="color:#34d399;"></i>
                </div>
                <div class="stat-number">
                    <i class="bi bi-compass-fill"
                       style="color:#34d399; font-size:1.8rem;"></i>
                </div>
                <div class="stat-label">Explore Opportunities</div>
                <a href="{{ route('jobs.index') }}" class="action-btn"
                   style="border-color:#34d399; color:#34d399;
                          background:rgba(52,211,153,0.08);">
                    <i class="bi bi-search"></i> Browse Jobs
                </a>
            </div>
        </div>

        {{-- Profile --}}
        <div class="col-md-4">
            <div class="dash-card">
                <div class="icon-box"
                     style="background:rgba(251,191,36,0.1);">
                    <i class="bi bi-person-badge-fill"
                       style="color:#fbbf24;"></i>
                </div>
                <div class="stat-number">
                    <i class="bi bi-patch-check-fill"
                       style="color:#fbbf24; font-size:1.8rem;"></i>
                </div>
                <div class="stat-label">Your Profile</div>
                <a href="{{ route('candidate.profile') }}" class="action-btn"
                   style="border-color:#fbbf24; color:#fbbf24;
                          background:rgba(251,191,36,0.08);">
                    <i class="bi bi-pencil-square"></i> View Profile
                </a>
            </div>
        </div>

    </div>

    {{-- Profile Summary --}}
    <div class="profile-card">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                @if($user->photo_path)
    <img src="{{ $user->getAvatarUrl() }}"
         alt="{{ $user->name }}"
         style="width:48px; height:48px; border-radius:50%;
                object-fit:cover; border:2px solid #7c3aed;">
@else
    <div style="width:48px; height:48px; background:#7c3aed;
                border-radius:50%; display:flex; align-items:center;
                justify-content:center; font-size:1.2rem;
                font-weight:800; color:#fff;">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
@endif
                <div>
                    <h5 class="text-white fw-bold mb-0">{{ $user->name }}</h5>
                    <span style="color:#a78bfa; font-size:0.8rem;">
                        {{ $user->email }}
                    </span>
                </div>
            </div>
            <span class="badge text-capitalize"
                  style="background:rgba(124,58,237,0.2);
                         color:#a78bfa; border:1px solid #7c3aed;
                         font-size:0.8rem; padding:6px 14px;">
                {{ $user->role }}
            </span>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="profile-label">Full Name</div>
                <div class="profile-field">{{ $user->name }}</div>
            </div>
            <div class="col-md-4">
                <div class="profile-label">Email Address</div>
                <div class="profile-field">{{ $user->email }}</div>
            </div>
            <div class="col-md-4">
                <div class="profile-label">Member Since</div>
                <div class="profile-field">
                    {{ $user->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('candidate.profile') }}"
               class="action-btn" style="width:auto; display:inline-flex;">
                <i class="bi bi-pencil-square"></i> Edit Profile
            </a>
        </div>
    </div>

</div>
@endsection