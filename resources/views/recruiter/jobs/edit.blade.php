@extends('layouts.app')
@section('title', 'Edit Job')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-pencil-square text-warning"></i> Edit Job
                </h4>
                <p class="text-muted small mt-1">Update the job details below</p>
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

                <form method="POST"
                      action="{{ route('recruiter.jobs.update', $job->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Job Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title', $job->title) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Company Name</label>
                            <input type="text" name="company_name" class="form-control"
                                   value="{{ old('company_name', $job->company_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Location</label>
                            <input type="text" name="location" class="form-control"
                                   value="{{ old('location', $job->location) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Salary <span class="text-muted">(optional)</span></label>
                            <input type="text" name="salary" class="form-control"
                                   value="{{ old('salary', $job->salary) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Job Type</label>
                            <select name="job_type" class="form-select" required>
                                <option value="full-time"  {{ old('job_type', $job->job_type) === 'full-time'  ? 'selected' : '' }}>Full-Time</option>
                                <option value="part-time"  {{ old('job_type', $job->job_type) === 'part-time'  ? 'selected' : '' }}>Part-Time</option>
                                <option value="remote"     {{ old('job_type', $job->job_type) === 'remote'     ? 'selected' : '' }}>Remote</option>
                                <option value="contract"   {{ old('job_type', $job->job_type) === 'contract'   ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Job Description</label>
                            <textarea name="description" class="form-control"
                                      rows="6" required>{{ old('description', $job->description) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('recruiter.jobs.index') }}"
                           class="btn btn-outline-secondary w-50">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-warning w-50">
                            <i class="bi bi-save"></i> Update Job
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection