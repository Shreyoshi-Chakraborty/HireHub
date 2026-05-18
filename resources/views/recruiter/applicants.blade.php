@extends('layouts.app')
@section('title', 'Applicants')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">All Applicants</h3>
        <p class="text-muted">Candidates who applied to your jobs</p>
    </div>
    <a href="{{ route('recruiter.dashboard') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        @forelse($applications as $application)
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">{{ $application->candidate->name }}</h5>
                    <p class="text-muted mb-1">
                        <i class="bi bi-envelope"></i> {{ $application->candidate->email }}
                    </p>
                    <p class="text-muted mb-1">
                        <i class="bi bi-briefcase"></i>
                        Applied for: <strong>{{ $application->job->title }}</strong>
                        at {{ $application->job->company_name }}
                    </p>
                    <small class="text-muted">
                        <i class="bi bi-calendar"></i>
                        {{ $application->created_at->format('M d, Y') }}
                    </small>
                </div>
                <div class="text-end">
                    @php
                        $badgeColor = match($application->status) {
                            'pending'  => 'warning',
                            'reviewed' => 'info',
                            'accepted' => 'success',
                            'rejected' => 'danger',
                            default    => 'secondary',
                        };
                    @endphp
                    <span class="badge bg-{{ $badgeColor }} fs-6 text-capitalize">
                        {{ $application->status }}
                    </span>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-inbox text-muted" style="font-size:3rem;"></i>
                <p class="text-muted mt-3">No applicants yet for your jobs.</p>
                <a href="{{ route('recruiter.jobs.create') }}" class="btn btn-primary">
                    Post a Job
                </a>
            </div>
        @endforelse
    </div>
</div>

@endsection