@extends('layouts.app')
@section('title', 'Edit Profile')

@push('styles')
<style>
    .profile-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 20px;
        padding: 2.5rem;
    }
    .avatar-wrapper {
        position: relative;
        width: 88px;
        margin: 0 auto;
        cursor: pointer;
    }
    .avatar-circle {
        width: 88px; height: 88px;
        background: linear-gradient(135deg, #5b21b6, #7c3aed);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 2.2rem; font-weight: 800; color: #fff;
        box-shadow: 0 0 0 4px rgba(124,58,237,0.2);
        overflow: hidden;
    }
    .avatar-circle img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    .avatar-overlay {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s;
    }
    .avatar-wrapper:hover .avatar-overlay {
        opacity: 1;
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
    .field-input {
        background: #0d0d1a;
        border: 1px solid #1e1e3a;
        border-radius: 10px;
        padding: 11px 16px;
        color: rgba(255,255,255,0.85);
        font-size: 0.92rem;
        width: 100%;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: 'Outfit', sans-serif;
        outline: none;
    }
    .field-input:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124,58,237,0.15);
    }
    .field-input.is-invalid {
        border-color: #ef4444;
    }
    .invalid-msg {
        color: #ef4444;
        font-size: 0.78rem;
        margin-top: 4px;
    }
    .photo-drop-zone {
        background: #0d0d1a;
        border: 2px dashed #2d2d5a;
        border-radius: 14px;
        padding: 24px 16px;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
    }
    .photo-drop-zone:hover,
    .photo-drop-zone.dragover {
        border-color: #7c3aed;
        background: rgba(124,58,237,0.05);
    }
    .photo-drop-zone p {
        color: rgba(255,255,255,0.4);
        font-size: 0.82rem;
        margin: 0;
    }
    #photo-preview {
        width: 72px; height: 72px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #7c3aed;
        display: none;
        margin: 0 auto 8px;
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
    .save-btn {
        background: linear-gradient(135deg, #5b21b6, #7c3aed);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 12px 32px;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: opacity 0.2s;
        font-family: 'Outfit', sans-serif;
        width: 100%;
    }
    .save-btn:hover {
        opacity: 0.88;
    }
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">

    <div class="mb-4">
        <h3 class="fw-bold mb-0 text-white">Edit Profile</h3>
        <p style="color:rgba(255,255,255,0.4); margin:0; font-size:0.9rem;">
            Update your name, email or profile photo
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="profile-card">

                {{-- Avatar — click to open file picker --}}
                <div class="text-center mb-4">
                    <div class="avatar-wrapper" onclick="document.getElementById('photo').click()">
                        <div class="avatar-circle" id="avatar-display">
                            @if($user->photo_path)
                                <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}">
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="avatar-overlay">
                            <i class="bi bi-camera-fill text-white" style="font-size:1.3rem;"></i>
                        </div>
                    </div>
                    <p style="color:rgba(255,255,255,0.35); font-size:0.75rem; margin-top:8px; margin-bottom:0;">
                        Click avatar to change photo
                    </p>
                    <h4 class="text-white fw-bold mt-2 mb-0">{{ $user->name }}</h4>
                    <span class="role-badge">{{ $user->role }}</span>
                </div>

                <form method="POST"
                      action="{{ route('candidate.profile.update') }}"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- Hidden file input --}}
                    <input type="file"
                           id="photo"
                           name="photo"
                           accept="image/jpeg,image/png,image/webp"
                           style="display:none;"
                           onchange="previewPhoto(this)">

                    {{-- Photo drop zone --}}
                    <div class="mb-4">
                        <div class="field-label">Profile Photo</div>
                        <div class="photo-drop-zone"
                             id="drop-zone"
                             onclick="document.getElementById('photo').click()"
                             ondragover="event.preventDefault(); this.classList.add('dragover')"
                             ondragleave="this.classList.remove('dragover')"
                             ondrop="handleDrop(event)">
                            <img id="photo-preview" alt="Preview">
                            <i class="bi bi-cloud-arrow-up"
                               style="font-size:1.8rem; color:#7c3aed; display:block; margin-bottom:6px;"
                               id="upload-icon"></i>
                            <p id="upload-hint">Click or drag &amp; drop to upload</p>
                            <p style="font-size:0.72rem; opacity:0.5; margin-top:4px;">JPG, PNG, WEBP · Max 2MB</p>
                        </div>
                        @error('photo')
                            <p class="invalid-msg">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Name + Email --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="field-label">Full Name</div>
                            <input type="text"
                                   name="name"
                                   class="field-input @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="Your full name"
                                   required>
                            @error('name')
                                <p class="invalid-msg">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="field-label">Email Address</div>
                            <input type="email"
                                   name="email"
                                   class="field-input @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="your@email.com"
                                   required>
                            @error('email')
                                <p class="invalid-msg">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="field-label">Role</div>
                            <div style="background:#0d0d1a; border:1px solid #1e1e3a;
                                        border-radius:10px; padding:11px 16px;
                                        color:rgba(255,255,255,0.4); font-size:0.92rem;
                                        text-transform:capitalize;">
                                {{ $user->role }}
                                <span style="font-size:0.75rem; opacity:0.5;">(cannot change)</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="field-label">Member Since</div>
                            <div style="background:#0d0d1a; border:1px solid #1e1e3a;
                                        border-radius:10px; padding:11px 16px;
                                        color:rgba(255,255,255,0.4); font-size:0.92rem;">
                                {{ $user->created_at->format('F d, Y') }}
                            </div>
                        </div>
                    </div>

                    <hr style="border-color:#1e1e3a; margin-bottom:1.5rem;">

                    <button type="submit" class="save-btn mb-4">
                        <i class="bi bi-check-circle me-2"></i> Save Changes
                    </button>

                    {{-- Action Buttons: Dashboard + My Applications + My Profile --}}
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('candidate.dashboard') }}" class="action-btn">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a href="{{ route('candidate.applications') }}" class="action-btn">
                            <i class="bi bi-file-earmark-text"></i> My Applications
                        </a>
                        <a href="{{ route('candidate.profile') }}" class="action-btn action-btn-solid">
                            <i class="bi bi-person"></i> My Profile
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function previewPhoto(input) {
        if (!input.files || !input.files[0]) return;
        showPreview(input.files[0]);
    }

    function handleDrop(e) {
        e.preventDefault();
        document.getElementById('drop-zone').classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (!file || !file.type.startsWith('image/')) return;
        const dt = new DataTransfer();
        dt.items.add(file);
        document.getElementById('photo').files = dt.files;
        showPreview(file);
    }

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Update drop zone
            const preview = document.getElementById('photo-preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
            document.getElementById('upload-icon').style.display = 'none';
            document.getElementById('upload-hint').textContent = file.name;
            // Update avatar circle at top
            document.getElementById('avatar-display').innerHTML =
                `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
        };
        reader.readAsDataURL(file);
    }
</script>
@endpush