@extends('layouts.app')
@section('title', 'Post a Job')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-plus-circle text-primary"></i> Post a New Job
                </h4>
                <p class="text-muted small mt-1">Fill in the details below</p>
            </div>
            <div class="card-body px-4 pb-4">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('recruiter.jobs.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Job Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title') }}"
                                   placeholder="e.g. Frontend Developer" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Company Name</label>
                            <input type="text" name="company_name" class="form-control"
                                   value="{{ old('company_name') }}"
                                   placeholder="e.g. Google Inc." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Location</label>
                            <input type="text" name="location" class="form-control"
                                   value="{{ old('location') }}"
                                   placeholder="e.g. New York, USA" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Salary <span class="text-muted">(optional)</span></label>
                            <input type="text" name="salary" class="form-control"
                                   value="{{ old('salary') }}"
                                   placeholder="e.g. $3000/month">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Job Type</label>
                            <select name="job_type" class="form-select" required>
                                <option value="" disabled selected>Select type</option>
                                <option value="full-time"  {{ old('job_type') === 'full-time'  ? 'selected' : '' }}>Full-Time</option>
                                <option value="part-time"  {{ old('job_type') === 'part-time'  ? 'selected' : '' }}>Part-Time</option>
                                <option value="remote"     {{ old('job_type') === 'remote'     ? 'selected' : '' }}>Remote</option>
                                <option value="contract"   {{ old('job_type') === 'contract'   ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Job Description</label>
                            <textarea name="description" class="form-control"
                                      rows="6"
                                      placeholder="Describe the role, requirements, responsibilities..."
                                      required>{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('recruiter.jobs.index') }}"
                           class="btn btn-outline-secondary w-50">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary w-50">
                            <i class="bi bi-send"></i> Post Job
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection