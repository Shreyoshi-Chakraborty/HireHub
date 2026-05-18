@extends('layouts.app')
@section('title', 'Applicants')

@push('styles')
<style>
    .applicant-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 14px;
        transition: all 0.3s;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }
    .applicant-card:hover {
        border-color: #7c3aed;
        box-shadow: 0 4px 24px rgba(124,58,237,0.12);
    }
    .applicant-name {
        font-size: 1.05rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 4px;
    }
    .applicant-meta {
        font-size: 0.82rem;
        color: rgba(255,255,255,0.45);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 3px;
    }
    .applicant-meta i {
        font-size: 0.85rem;
    }
    .status-badge {
        font-size: 0.78rem;
        font-weight: 700;
        border-radius: 50px;
        padding: 4px 14px;
        white-space: nowrap;
        text-transform: capitalize;
    }
    .badge-pending {
        background: rgba(251,191,36,0.12);
        color: #fbbf24;
        border: 1px solid rgba(251,191,36,0.3);
    }
    .badge-accepted {
        background: rgba(52,211,153,0.1);
        color: #34d399;
        border: 1px solid rgba(52,211,153,0.25);
    }
    .badge-rejected {
        background: rgba(239,68,68,0.1);
        color: #ef4444;
        border: 1px solid rgba(239,68,68,0.25);
    }
    .badge-reviewed {
        background: rgba(99,179,237,0.1);
        color: #63b3ed;
        border: 1px solid rgba(99,179,237,0.25);
    }
    .action-area {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
        flex-shrink: 0;
    }
    .btn-accept {
        background: rgba(52,211,153,0.1);
        border: 1px solid rgba(52,211,153,0.3);
        color: #34d399;
        border-radius: 8px;
        padding: 6px 16px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-accept:hover {
        background: #34d399;
        color: #0d0d1a;
    }
    .btn-reject {
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.25);
        color: #ef4444;
        border-radius: 8px;
        padding: 6px 16px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-reject:hover {
        background: #ef4444;
        color: #fff;
    }
    .btn-pending {
        background: rgba(251,191,36,0.1);
        border: 1px solid rgba(251,191,36,0.25);
        color: #fbbf24;
        border-radius: 8px;
        padding: 6px 16px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-pending:hover {
        background: #fbbf24;
        color: #0d0d1a;
    }
    .action-buttons {
        display: flex;
        gap: 8px;
    }
</style>
@endpush

@section('content')
<div class="p-4" style="background:#0d0d1a; min-height:100vh;">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0 text-white">All Applicants</h3>
            <p style="color:rgba(255,255,255,0.4); font-size:0.88rem; margin:0;">
                Candidates who applied to your jobs
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

    @if(session('success'))
        <div style="background:rgba(52,211,153,0.1); border:1px solid rgba(52,211,153,0.25);
                    color:#34d399; border-radius:10px; padding:12px 16px; margin-bottom:16px;
                    font-size:0.88rem;">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Applicant Cards --}}
    @forelse($applications as $application)
        @php
            $status = $application->status;
        @endphp
        <div class="applicant-card">
            {{-- Left: Info --}}
            <div style="flex:1; min-width:0;">
                <div class="applicant-name">{{ $application->candidate->name }}</div>

                <div class="applicant-meta">
                    <i class="bi bi-envelope"></i>
                    {{ $application->candidate->email }}
                </div>

                <div class="applicant-meta">
                    <i class="bi bi-briefcase"></i>
                    Applied for:
                    <strong style="color:rgba(255,255,255,0.75);">
                        {{ $application->job->title }}
                    </strong>
                    <span>at {{ $application->job->company_name }}</span>
                </div>

                <div class="applicant-meta">
                    <i class="bi bi-calendar3"></i>
                    {{ $application->created_at->format('M d, Y') }}
                </div>
            </div>

            {{-- Right: Status + Actions --}}
            <div class="action-area">
                {{-- Status Badge --}}
                <span class="status-badge
                    @if($status === 'accepted') badge-accepted
                    @elseif($status === 'rejected') badge-rejected
                    @elseif($status === 'reviewed') badge-reviewed
                    @else badge-pending
                    @endif">
                    @if($status === 'accepted')
                        <i class="bi bi-check-circle me-1"></i>
                    @elseif($status === 'rejected')
                        <i class="bi bi-x-circle me-1"></i>
                    @else
                        <i class="bi bi-clock me-1"></i>
                    @endif
                    {{ ucfirst($status) }}
                </span>

                {{-- Action Buttons --}}
                <div class="action-buttons">
                    @if($status !== 'accepted')
                        <form method="POST"
                              action="{{ route('recruiter.applicants.updateStatus', $application) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="btn-accept">
                                <i class="bi bi-check-lg me-1"></i> Accept
                            </button>
                        </form>
                    @endif

                    @if($status !== 'rejected')
                        <form method="POST"
                              action="{{ route('recruiter.applicants.updateStatus', $application) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn-reject">
                                <i class="bi bi-x-lg me-1"></i> Reject
                            </button>
                        </form>
                    @endif

                    @if($status !== 'pending')
                        <form method="POST"
                              action="{{ route('recruiter.applicants.updateStatus', $application) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="pending">
                            <button type="submit" class="btn-pending">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Pending
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div style="text-align:center; padding:4rem 0;">
            <i class="bi bi-inbox" style="font-size:3rem; color:rgba(255,255,255,0.15);
                                          display:block; margin-bottom:12px;"></i>
            <p style="color:rgba(255,255,255,0.3); font-size:0.95rem;">
                No applicants yet for your jobs.
            </p>
            <a href="{{ route('recruiter.jobs.create') }}"
               style="color:#a78bfa; font-weight:600; text-decoration:none;">
                Post a Job →
            </a>
        </div>
    @endforelse

</div>
@endsection