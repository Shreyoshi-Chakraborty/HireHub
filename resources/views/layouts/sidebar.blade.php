{{-- SIDEBAR — role-based links --}}
<div style="position:sticky; top:0; height:100vh;
            width:100%; background:#13132a;
            border-right:1px solid #1e1e3a;
            display:flex; flex-direction:column; padding:1.5rem 1rem;
            overflow-y:auto; scrollbar-width:none; -ms-overflow-style:none;">
<style>
    .sidebar-inner::-webkit-scrollbar { display: none; }
</style>

    {{-- User Avatar --}}
    <div class="text-center mb-4">
        @if(Auth::user()->photo_path)
            <img src="{{ Auth::user()->getAvatarUrl() }}"
                 alt="{{ Auth::user()->name }}"
                 style="width:56px; height:56px; border-radius:50%;
                        object-fit:cover; border:2px solid #7c3aed;
                        display:block; margin:0 auto;">
        @else
            <div style="width:56px; height:56px; background:#7c3aed;
                        border-radius:50%; display:flex; align-items:center;
                        justify-content:center; font-size:1.4rem; font-weight:800;
                        color:#fff; margin:0 auto;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
        <p class="text-white mt-2 mb-0 fw-bold" style="font-size:0.95rem;">
            {{ Auth::user()->name }}
        </p>
        <span class="badge mt-1 text-capitalize"
              style="background:rgba(124,58,237,0.2);
                     color:#a78bfa; border:1px solid #7c3aed;
                     font-size:0.72rem;">
            {{ Auth::user()->role }}
        </span>
    </div>

    <hr style="border-color:#1e1e3a; margin:0 0 1rem;">

    @if(Auth::user()->role === 'recruiter')

        <p style="color:#6c757d; font-size:0.7rem; text-transform:uppercase;
                  letter-spacing:1.5px; padding:0 8px; margin-bottom:8px;">
            Recruiter Menu
        </p>

        @php
            $myJobsActive   = request()->routeIs('recruiter.jobs.index')
                           || request()->routeIs('recruiter.jobs.show')
                           || request()->routeIs('recruiter.jobs.edit');
            $postJobActive  = request()->routeIs('recruiter.jobs.create');
        @endphp

        <a href="{{ route('recruiter.dashboard') }}"
           style="display:flex; align-items:center; gap:12px; padding:10px 12px;
                  border-radius:10px; text-decoration:none; margin-bottom:4px;
                  font-size:0.9rem; font-weight:600; transition:all 0.2s;
                  {{ request()->routeIs('recruiter.dashboard') ? 'background:#7c3aed; color:#fff;' : 'color:#a78bfa;' }}">
            <i class="bi bi-speedometer2" style="font-size:1.1rem;"></i>
            Dashboard
        </a>

        <a href="{{ route('recruiter.jobs.index') }}"
           style="display:flex; align-items:center; gap:12px; padding:10px 12px;
                  border-radius:10px; text-decoration:none; margin-bottom:4px;
                  font-size:0.9rem; font-weight:600; transition:all 0.2s;
                  {{ $myJobsActive ? 'background:#7c3aed; color:#fff;' : 'color:#a78bfa;' }}">
            <i class="bi bi-briefcase" style="font-size:1.1rem;"></i>
            My Jobs
        </a>

        <a href="{{ route('recruiter.jobs.create') }}"
           style="display:flex; align-items:center; gap:12px; padding:10px 12px;
                  border-radius:10px; text-decoration:none; margin-bottom:4px;
                  font-size:0.9rem; font-weight:600; transition:all 0.2s;
                  {{ $postJobActive ? 'background:#7c3aed; color:#fff;' : 'color:#a78bfa;' }}">
            <i class="bi bi-plus-circle" style="font-size:1.1rem;"></i>
            Post a Job
        </a>

        <a href="{{ route('recruiter.applicants') }}"
           style="display:flex; align-items:center; gap:12px; padding:10px 12px;
                  border-radius:10px; text-decoration:none; margin-bottom:4px;
                  font-size:0.9rem; font-weight:600; transition:all 0.2s;
                  {{ request()->routeIs('recruiter.applicants') ? 'background:#7c3aed; color:#fff;' : 'color:#a78bfa;' }}">
            <i class="bi bi-people" style="font-size:1.1rem;"></i>
            Applicants
        </a>

    @elseif(Auth::user()->role === 'candidate')

        <p style="color:#6c757d; font-size:0.7rem; text-transform:uppercase;
                  letter-spacing:1.5px; padding:0 8px; margin-bottom:8px;">
            Candidate Menu
        </p>

        <a href="{{ route('candidate.dashboard') }}"
           style="display:flex; align-items:center; gap:12px; padding:10px 12px;
                  border-radius:10px; text-decoration:none; margin-bottom:4px;
                  font-size:0.9rem; font-weight:600; transition:all 0.2s;
                  {{ request()->routeIs('candidate.dashboard') ? 'background:#7c3aed; color:#fff;' : 'color:#a78bfa;' }}">
            <i class="bi bi-speedometer2" style="font-size:1.1rem;"></i>
            Dashboard
        </a>

        <a href="{{ route('jobs.index') }}"
           style="display:flex; align-items:center; gap:12px; padding:10px 12px;
                  border-radius:10px; text-decoration:none; margin-bottom:4px;
                  font-size:0.9rem; font-weight:600; transition:all 0.2s;
                  {{ request()->routeIs('jobs.index') ? 'background:#7c3aed; color:#fff;' : 'color:#a78bfa;' }}">
            <i class="bi bi-search" style="font-size:1.1rem;"></i>
            Browse Jobs
        </a>

        <a href="{{ route('candidate.applications') }}"
           style="display:flex; align-items:center; gap:12px; padding:10px 12px;
                  border-radius:10px; text-decoration:none; margin-bottom:4px;
                  font-size:0.9rem; font-weight:600; transition:all 0.2s;
                  {{ request()->routeIs('candidate.applications') ? 'background:#7c3aed; color:#fff;' : 'color:#a78bfa;' }}">
            <i class="bi bi-file-earmark-text" style="font-size:1.1rem;"></i>
            My Applications
        </a>

        <a href="{{ route('candidate.profile') }}"
           style="display:flex; align-items:center; gap:12px; padding:10px 12px;
                  border-radius:10px; text-decoration:none; margin-bottom:4px;
                  font-size:0.9rem; font-weight:600; transition:all 0.2s;
                  {{ request()->routeIs('candidate.profile') && !request()->routeIs('candidate.profile.edit') ? 'background:#7c3aed; color:#fff;' : 'color:#a78bfa;' }}">
            <i class="bi bi-person" style="font-size:1.1rem;"></i>
            My Profile
        </a>

        <a href="{{ route('candidate.profile.edit') }}"
           style="display:flex; align-items:center; gap:12px; padding:10px 12px;
                  border-radius:10px; text-decoration:none; margin-bottom:4px;
                  font-size:0.9rem; font-weight:600; transition:all 0.2s;
                  {{ request()->routeIs('candidate.profile.edit') ? 'background:#7c3aed; color:#fff;' : 'color:#a78bfa;' }}">
            <i class="bi bi-pencil-square" style="font-size:1.1rem;"></i>
            Edit Profile
        </a>

    @endif

    <div style="flex:1;"></div>

    {{-- Promo card --}}
    <div style="background:linear-gradient(135deg, #3b0f8c 0%, #7c3aed 100%);
                border-radius:14px; padding:18px 16px; margin-bottom:0.85rem;
                text-align:center;">
        <i class="bi bi-rocket-takeoff-fill text-white" style="font-size:1.5rem;"></i>
        <p class="text-white fw-bold mt-2 mb-1" style="font-size:0.85rem;">
            @if(Auth::user()->role === 'recruiter')
                Build Your Profile
            @else
                Complete Your Profile
            @endif
        </p>
        <p style="color:rgba(255,255,255,0.65); font-size:0.75rem; margin-bottom:10px;">
            @if(Auth::user()->role === 'recruiter')
                Attract top candidates
            @else
                Stand out to recruiters
            @endif
        </p>

       @if(Auth::user()->role === 'recruiter')
    <a href="{{ route('recruiter.profile') }}"
       style="background:#fff; color:#7c3aed; border-radius:8px;
              padding:6px 16px; font-size:0.8rem; font-weight:700;
              text-decoration:none; display:inline-block;">
        Edit Profile
    </a>
        @else
            @if(request()->routeIs('candidate.profile') && !request()->routeIs('candidate.profile.edit'))
                <a href="{{ route('candidate.profile.edit') }}"
                   style="background:#fff; color:#7c3aed; border-radius:8px;
                          padding:6px 16px; font-size:0.8rem; font-weight:700;
                          text-decoration:none; display:inline-block;">
                    Edit Profile
                </a>
            @else
                <a href="{{ route('candidate.profile') }}"
                   style="background:#fff; color:#7c3aed; border-radius:8px;
                          padding:6px 16px; font-size:0.8rem; font-weight:700;
                          text-decoration:none; display:inline-block;">
                    View Profile
                </a>
            @endif
        @endif
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                style="width:100%; padding:10px; background:transparent;
                       border:1px solid rgba(239,68,68,0.35); border-radius:10px;
                       color:#ef4444; font-size:0.88rem; font-weight:600;
                       cursor:pointer; transition:all 0.2s; font-family:'Outfit',sans-serif;"
                onmouseover="this.style.background='rgba(239,68,68,0.1)'"
                onmouseout="this.style.background='transparent'">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>

</div>