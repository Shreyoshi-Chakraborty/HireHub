@extends('layouts.app')
@section('title', 'My Profile')

@push('styles')
<style>
    .profile-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 20px;
        padding: 2.5rem;
    }
    .avatar-circle {
        width: 88px; height: 88px;
        background: linear-gradient(135deg, #5b21b6, #7c3aed);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 2.2rem; font-weight: 800; color: #fff;
        margin: 0 auto;
        box-shadow: 0 0 0 4px rgba(124,58,237,0.2);
        overflow: hidden;
    }
    .avatar-circle img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    .role-badge {
        display: inline-block;
        background: rgba(124,58,237,0.15);
        color: #a78bfa;
        border: 1px solid #7c3aed;
        border-radius: 50px;
        padding: 4px 18px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
        margin-top: 0.5rem;
    }
    .field-label {
        color: rgba(255,255,255,0.35);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 6px;
    }
    .field-value {
        background: #0d0d1a;
        border: 1px solid #1e1e3a;
        border-radius: 10px;
        padding: 11px 16px;
        color: rgba(255,255,255,0.75);
        font-size: 0.92rem;
        word-break: break-all;
        overflow-wrap: break-word;
    }
    .stat-mini {
        background: #0d0d1a;
        border: 1px solid #1e1e3a;
        border-radius: 14px;
        padding: 18px;
        text-align: center;
        flex: 1;
    }
    .stat-mini-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: #a78bfa;
        line-height: 1;
    }
    .stat-mini-label {
        color: rgba(255,255,255,0.4);
        font-size: 0.78rem;
        margin-top: 4px;
    }
    .photo-upload-box {
        background: #0d0d1a;
        border: 1px dashed #2d2d5a;
        border-radius: 14px;
        padding: 18px;
        text-align: center;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: border-color 0.2s;
    }
    .photo-upload-box:hover {
        border-color: #7c3aed;
    }
    .photo-upload-box p {
        color: rgba(255,255,255,0.4);
        font-size: 0.75rem;
        margin: 0;
    }
    .photo-preview-thumb {
        width: 44px; height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #7c3aed;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 20px;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid #7c3aed;
        color: #a78bfa;
        background: rgba(124,58,237,0.1);
        flex: 1;
    }
    .action-btn:hover {
        background: #7c3aed;
        color: #fff;
    }
    .action-btn-solid {
        background: #7c3aed;
        color: #fff;
        border-color: #7c3aed;
    }
    .action-btn-solid:hover {
        background: #5b21b6;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">

    <div class="mb-4">
        <h3 class="fw-bold mb-0 text-white">My Profile</h3>
        <p style="color:rgba(255,255,255,0.4); margin:0; font-size:0.9rem;">
            Your account information
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="profile-card">

                {{-- Avatar + Name --}}
                <div class="text-center mb-4">
                    <div class="avatar-circle">
                        @if($user->photo_path)
                            <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}">
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </div>
                    <h4 class="text-white fw-bold mt-3 mb-0">{{ $user->name }}</h4>
                    <span class="role-badge">{{ $user->role }}</span>
                </div>

                {{-- Stats: Applications | Accepted | Upload Photo --}}
                <div class="d-flex gap-3 mb-4">
                    <div class="stat-mini">
                        <div class="stat-mini-number">{{ $user->applications()->count() }}</div>
                        <div class="stat-mini-label">Applications</div>
                    </div>
                    <div class="stat-mini">
                        <div class="stat-mini-number">
                            {{ $user->applications()->where('status','accepted')->count() }}
                        </div>
                        <div class="stat-mini-label">Accepted</div>
                    </div>
                    {{-- Clicking this takes you to edit profile to upload photo --}}
                    <a href="{{ route('candidate.profile.edit') }}" class="photo-upload-box text-decoration-none">
                        @if($user->photo_path)
                            <img src="{{ $user->getAvatarUrl() }}" class="photo-preview-thumb" alt="Photo">
                            <p style="color:#a78bfa; font-weight:600; font-size:0.78rem;">Change Photo</p>
                        @else
                            <i class="bi bi-camera" style="font-size:1.4rem; color:#7c3aed;"></i>
                            <p>Upload Photo</p>
                            <p style="font-size:0.7rem; opacity:0.6;">JPG, PNG, WEBP · 2MB max</p>
                        @endif
                    </a>
                </div>

                <hr style="border-color:#1e1e3a; margin-bottom:1.5rem;">

                {{-- Profile Fields — min-width:0 on col fixes email overflow --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6" style="min-width:0;">
                        <div class="field-label">Full Name</div>
                        <div class="field-value">{{ $user->name }}</div>
                    </div>
                    <div class="col-md-6" style="min-width:0;">
                        <div class="field-label">Email Address</div>
                        <div class="field-value">{{ $user->email }}</div>
                    </div>
                    <div class="col-md-6" style="min-width:0;">
                        <div class="field-label">Role</div>
                        <div class="field-value text-capitalize">{{ $user->role }}</div>
                    </div>
                    <div class="col-md-6" style="min-width:0;">
                        <div class="field-label">Member Since</div>
                        <div class="field-value">{{ $user->created_at->format('F d, Y') }}</div>
                    </div>
                </div>

                <hr style="border-color:#1e1e3a; margin-bottom:1.5rem;">

                {{-- Action Buttons: Dashboard + My Applications ONLY. No Edit button here. --}}
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('candidate.dashboard') }}" class="action-btn">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('candidate.applications') }}" class="action-btn action-btn-solid">
                        <i class="bi bi-file-earmark-text"></i> My Applications
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection