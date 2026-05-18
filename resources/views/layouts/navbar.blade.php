{{-- CHANGE NAVBAR HERE --}}
<nav class="navbar navbar-expand-lg px-4 py-3"
     style="background-color:#13132a; border-bottom:1px solid #1e1e3a; position:relative;">

    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
        <img src="{{ asset('assets/logo.jpg') }}"
             alt="HireHub Logo"
             style="height:32px; width:32px; border-radius:6px;"
             onerror="this.style.display='none'">
        <span style="color:#fff; font-weight:800; font-size:1.4rem; letter-spacing:1px;">
            Hire<span style="color:#a78bfa;">Hub</span>
        </span>
    </a>

    <button class="navbar-toggler border-0" type="button"
            data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon" style="filter:invert(1);"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">

        @guest
            <div class="position-absolute start-50 translate-middle-x d-none d-lg-flex" style="z-index:1;">
                <ul class="navbar-nav flex-row gap-1">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ route('home') }}"
                           style="color:rgba(255,255,255,0.8); font-weight:500;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ route('home') }}#about"
                           style="color:rgba(255,255,255,0.8); font-weight:500;">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ route('home') }}#how-it-works"
                           style="color:rgba(255,255,255,0.8); font-weight:500;">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ route('home') }}#contact"
                           style="color:rgba(255,255,255,0.8); font-weight:500;">Contact</a>
                    </li>
                </ul>
            </div>

            <ul class="navbar-nav d-lg-none mb-2 mt-1">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}"
                       style="color:rgba(255,255,255,0.8);">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#about"
                       style="color:rgba(255,255,255,0.8);">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#how-it-works"
                       style="color:rgba(255,255,255,0.8);">How It Works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#contact"
                       style="color:rgba(255,255,255,0.8);">Contact</a>
                </li>
            </ul>
        @endguest

        <ul class="navbar-nav ms-auto align-items-center gap-2">

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"
                       style="color:rgba(255,255,255,0.8);">
                        <i class="bi bi-box-arrow-in-right"></i> Log in
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm px-3 py-2"
                       href="{{ route('register') }}"
                       style="background:#7c3aed; color:#fff; border-radius:8px;">
                        Register
                    </a>
                </li>
            @endguest

            @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                       class="d-flex align-items-center gap-2 px-3 py-2 text-decoration-none"
                       style="background:#1e1e3a; border:1px solid #2d2d5a;
                              border-radius:8px; color:rgba(255,255,255,0.7);
                              font-size:0.85rem; font-weight:600; transition:all 0.2s;"
                       onmouseover="this.style.borderColor='#7c3aed'; this.style.color='#a78bfa';"
                       onmouseout="this.style.borderColor='#2d2d5a'; this.style.color='rgba(255,255,255,0.7)';">
                        <i class="bi bi-house-fill"></i> Home
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                       href="#" data-bs-toggle="dropdown"
                       style="color:#a78bfa;">
                        {{-- Show photo if uploaded, else initial letter --}}
                        @if(Auth::user()->photo_path)
                            <img src="{{ Auth::user()->getAvatarUrl() }}"
                                 alt="{{ Auth::user()->name }}"
                                 style="width:32px; height:32px; border-radius:50%;
                                        object-fit:cover; border:2px solid #7c3aed;">
                        @else
                            <div style="width:32px; height:32px; background:#7c3aed;
                                        border-radius:50%; display:flex; align-items:center;
                                        justify-content:center; font-size:0.85rem;
                                        font-weight:700; color:#fff;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end"
                        style="background:#13132a; border:1px solid #1e1e3a;
                               border-radius:12px; padding:8px;">
                        @if(Auth::user()->role === 'recruiter')
                            <li>
                                <a class="dropdown-item rounded-2" style="color:#a78bfa;"
                                   href="{{ route('recruiter.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item rounded-2" style="color:#a78bfa;"
                                   href="{{ route('candidate.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a>
                            </li>
                        @endif
                        <li><hr class="dropdown-divider" style="border-color:#1e1e3a;"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item rounded-2 text-danger" type="submit">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth

        </ul>
    </div>
</nav>