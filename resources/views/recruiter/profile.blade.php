@extends('layouts.app')
@section('title', 'My Profile')

@push('styles')
<style>
    .profile-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 20px;
        padding: 2rem 2.5rem;
        transition: all 0.3s;
    }
    .profile-card:hover {
        border-color: #7c3aed;
        box-shadow: 0 4px 32px rgba(124,58,237,0.12);
    }
    .dark-label {
        color: rgba(255,255,255,0.75);
        font-size: 0.88rem;
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }
    .dark-input {
        background: #0d0d1a !important;
        border: 1px solid #1e1e3a !important;
        border-radius: 10px !important;
        color: #fff !important;
        padding: 10px 14px !important;
        font-size: 0.9rem !important;
        transition: border-color 0.2s !important;
        width: 100%;
    }
    .dark-input:focus {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 3px rgba(124,58,237,0.15) !important;
        outline: none !important;
    }
    .dark-input::placeholder {
        color: rgba(255,255,255,0.2) !important;
    }
    .avatar-ring {
        width: 90px; height: 90px;
        border-radius: 50%;
        border: 3px solid #7c3aed;
        object-fit: cover;
    }
    .avatar-initial {
        width: 90px; height: 90px;
        border-radius: 50%;
        background: #7c3aed;
        display: flex; align-items: center;
        justify-content: center;
        font-size: 2rem; font-weight: 800;
        color: #fff;
        border: 3px solid #5b21b6;
    }
    .btn-save {
        background: linear-gradient(135deg, #5b21b6 0%, #7c3aed 100%);
        border: none;
        color: #fff;
        border-radius: 10px;
        padding: 10px 28px;
        font-size: 0.9rem;
        font-weight: 700;
        transition: all 0.2s;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-save:hover {
        background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        box-shadow: 0 4px 20px rgba(124,58,237,0.35);
        color: #fff;
    }
    .photo-upload-area {
        background: #0d0d1a;
        border: 1px dashed #1e1e3a;
        border-radius: 12px;
        padding: 14px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: border-color 0.2s;
        cursor: pointer;
    }
    .photo-upload-area:hover {
        border-color: #7c3aed;
    }
    .upload-btn {
        background: rgba(124,58,237,0.12);
        border: 1px solid rgba(124,58,237,0.3);
        color: #a78bfa;
        border-radius: 8px;
        padding: 7px 16px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .upload-btn:hover {
        background: #7c3aed;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-0 text-white">My Profile</h3>
                    <p style="color:rgba(255,255,255,0.4); font-size:0.88rem; margin:0;">
                        Manage your recruiter profile
                    </p>
                </div>
                <a href="{{ route('recruiter.dashboard') }}"
                   style="background:rgba(255,255,255,0.05); border:1px solid #1e1e3a;
                          color:rgba(255,255,255,0.6); border-radius:10px; padding:8px 18px;
                          font-size:0.85rem; font-weight:600; text-decoration:none;
                          display:inline-flex; align-items:center; gap:6px; transition:all 0.2s;"
                   onmouseover="this.style.borderColor='#7c3aed'; this.style.color='#a78bfa'"
                   onmouseout="this.style.borderColor='#1e1e3a'; this.style.color='rgba(255,255,255,0.6)'">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            {{-- Success --}}
            @if(session('success'))
                <div style="background:rgba(52,211,153,0.1); border:1px solid rgba(52,211,153,0.25);
                            color:#34d399; border-radius:10px; padding:12px 16px; margin-bottom:16px;
                            font-size:0.88rem;">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.25);
                            color:#ef4444; border-radius:10px; padding:12px 16px; margin-bottom:16px;
                            font-size:0.85rem;">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="profile-card">

                <form method="POST"
                      action="{{ route('recruiter.profile.update') }}"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- Photo Upload --}}
                    <div class="mb-4">
                        <label class="dark-label">Profile Photo</label>
                        <div class="photo-upload-area"
                             onclick="document.getElementById('photoInput').click()">
                            {{-- Avatar preview --}}
                            <div id="avatarPreview">
                                @if($user->photo_path)
                                    <img src="{{ $user->getAvatarUrl() }}"
                                         alt="avatar" class="avatar-ring" id="previewImg">
                                @else
                                    <div class="avatar-initial" id="avatarInitial">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="upload-btn">
                                    <i class="bi bi-upload me-1"></i> Upload Photo
                                </div>
                                <p style="color:rgba(255,255,255,0.3); font-size:0.78rem;
                                          margin:6px 0 0;">
                                    JPG, PNG, WEBP — max 2MB
                                </p>
                            </div>
                            <input type="file" id="photoInput" name="photo"
                                   accept="image/*" style="display:none"
                                   onchange="previewPhoto(event)">
                        </div>
                    </div>

                    <hr style="border-color:#1e1e3a; margin:1.5rem 0;">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="dark-label">Full Name</label>
                            <input type="text" name="name"
                                   class="dark-input"
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="e.g. John Doe" required>
                        </div>

                        <div class="col-md-6">
                            <label class="dark-label">Email Address</label>
                            <input type="email" name="email"
                                   class="dark-input"
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="e.g. john@company.com" required>
                        </div>

                        <div class="col-md-6">
                            <label class="dark-label">
                                Position / Title
                                <span style="color:rgba(255,255,255,0.3); font-weight:400;">(optional)</span>
                            </label>
                            <input type="text" name="position"
                                   class="dark-input"
                                   value="{{ old('position', $user->position) }}"
                                   placeholder="e.g. HR Manager">
                        </div>

                        <div class="col-md-6">
                            <label class="dark-label">
                                Company Name
                                <span style="color:rgba(255,255,255,0.3); font-weight:400;">(optional)</span>
                            </label>
                            <input type="text" name="company_name"
                                   class="dark-input"
                                   value="{{ old('company_name', $user->company_name) }}"
                                   placeholder="e.g. Google Inc.">
                        </div>

                        <div class="col-md-6">
                            <label class="dark-label">
                                Phone
                                <span style="color:rgba(255,255,255,0.3); font-weight:400;">(optional)</span>
                            </label>
                            <input type="text" name="phone"
                                   class="dark-input"
                                   value="{{ old('phone', $user->phone) }}"
                                   placeholder="e.g. +91 98765 43210">
                        </div>

                    </div>

                    <hr style="border-color:#1e1e3a; margin:1.5rem 0;">

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-lg"></i> Save Changes
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatarPreview');
            preview.innerHTML = `
                <img src="${e.target.result}"
                     alt="preview"
                     class="avatar-ring"
                     style="width:90px; height:90px; border-radius:50%;
                            border:3px solid #7c3aed; object-fit:cover;">
            `;
        };
        reader.readAsDataURL(file);
    }
</script>
@endpush

@endsection