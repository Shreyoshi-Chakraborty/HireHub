@extends('layouts.app')
@section('title', 'Edit Job')

@push('styles')
<style>
    .form-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 20px;
        padding: 2rem 2.5rem;
        transition: all 0.3s;
    }
    .form-card:hover {
        border-color: #7c3aed;
        box-shadow: 0 4px 32px rgba(124,58,237,0.12);
    }
    .dark-label {
        color: rgba(255,255,255,0.75);
        font-size: 0.88rem;
        font-weight: 600;
        margin-bottom: 6px;
    }
    .dark-input {
        background: #0d0d1a !important;
        border: 1px solid #1e1e3a !important;
        border-radius: 10px !important;
        color: #fff !important;
        padding: 10px 14px !important;
        font-size: 0.9rem !important;
        transition: border-color 0.2s !important;
    }
    .dark-input:focus {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 3px rgba(124,58,237,0.15) !important;
        outline: none !important;
    }
    .dark-input::placeholder {
        color: rgba(255,255,255,0.2) !important;
    }
    .dark-input option {
        background: #13132a;
        color: #fff;
    }
    .btn-cancel {
        background: transparent;
        border: 1px solid #1e1e3a;
        color: rgba(255,255,255,0.5);
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 0.9rem;
        font-weight: 600;
        width: 100%;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-cancel:hover {
        border-color: #ef4444;
        color: #ef4444;
        background: rgba(239,68,68,0.07);
    }
    .btn-update {
        background: linear-gradient(135deg, #92620a 0%, #fbbf24 100%);
        border: none;
        color: #0d0d1a;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 0.9rem;
        font-weight: 700;
        width: 100%;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
    }
    .btn-update:hover {
        background: linear-gradient(135deg, #fbbf24 0%, #fde68a 100%);
        box-shadow: 0 4px 20px rgba(251,191,36,0.3);
        color: #0d0d1a;
    }
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">

            <div class="form-card">

                {{-- Header --}}
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <div style="width:36px; height:36px; background:rgba(251,191,36,0.12);
                                    border-radius:10px; display:flex; align-items:center;
                                    justify-content:center;">
                            <i class="bi bi-pencil-square" style="color:#fbbf24; font-size:1.1rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-0 text-white">Edit Job</h4>
                    </div>
                    <p style="color:rgba(255,255,255,0.35); font-size:0.85rem; margin:0 0 0 44px;">
                        Update the job details below
                    </p>
                </div>

                {{-- Errors --}}
                @if($errors->any())
                    <div style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.25);
                                color:#ef4444; border-radius:10px; padding:12px 16px; margin-bottom:20px;
                                font-size:0.85rem;">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('recruiter.jobs.update', $job->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="dark-label">Job Title</label>
                            <input type="text" name="title"
                                   class="form-control dark-input"
                                   value="{{ old('title', $job->title) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="dark-label">Company Name</label>
                            <input type="text" name="company_name"
                                   class="form-control dark-input"
                                   value="{{ old('company_name', $job->company_name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="dark-label">Location</label>
                            <input type="text" name="location"
                                   class="form-control dark-input"
                                   value="{{ old('location', $job->location) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="dark-label">
                                Salary
                                <span style="color:rgba(255,255,255,0.3); font-weight:400;">(optional)</span>
                            </label>
                            <input type="text" name="salary"
                                   class="form-control dark-input"
                                   value="{{ old('salary', $job->salary) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="dark-label">Job Type</label>
                            <select name="job_type" class="form-select dark-input" required>
                                <option value="full-time"  {{ old('job_type', $job->job_type) === 'full-time'  ? 'selected' : '' }}>Full-Time</option>
                                <option value="part-time"  {{ old('job_type', $job->job_type) === 'part-time'  ? 'selected' : '' }}>Part-Time</option>
                                <option value="remote"     {{ old('job_type', $job->job_type) === 'remote'     ? 'selected' : '' }}>Remote</option>
                                <option value="contract"   {{ old('job_type', $job->job_type) === 'contract'   ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="dark-label">
                                Expiry Date
                                <span style="color:rgba(255,255,255,0.3); font-weight:400;">(optional)</span>
                            </label>
                            <input type="date" name="expires_at"
                                   class="form-control dark-input"
                                   value="{{ old('expires_at', $job->expires_at?->toDateString()) }}"
                                   min="{{ now()->toDateString() }}"
                                   style="color-scheme: dark;">
                        </div>

                        <div class="col-12">
                            <label class="dark-label">Job Description</label>
                            <textarea name="description"
                                      class="form-control dark-input"
                                      rows="6"
                                      required>{{ old('description', $job->description) }}</textarea>
                        </div>

                    </div>

                    <hr style="border-color:#1e1e3a; margin:1.5rem 0;">

                    <div class="d-flex gap-3">
                        <a href="{{ route('recruiter.jobs.index') }}" class="btn-cancel">
                            Cancel
                        </a>
                        <button type="submit" class="btn-update">
                            <i class="bi bi-save"></i> Update Job
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection