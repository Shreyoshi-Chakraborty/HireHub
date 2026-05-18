<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireHub — Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            height: 100%;
            font-family: 'Outfit', sans-serif;
            background: #0d0d1a;
        }

        .shell {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* ── HOME BUTTON ── */
        .home-btn {
            position: fixed;
            top: 1.1rem;
            right: 1.4rem;
            z-index: 200;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.6);
            font-size: 0.82rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 8px;
            border: 1px solid #1e1e3a;
            background: rgba(13,13,26,0.85);
            backdrop-filter: blur(8px);
            transition: all 0.2s;
        }
        .home-btn:hover {
            color: #fff;
            border-color: #a78bfa;
            background: rgba(124,58,237,0.12);
        }

        /* ── LEFT PANEL ── */
        .left {
            width: 50%;
            flex-shrink: 0;
            min-height: 100vh;
            background: #0d0d1a;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5rem 3rem;
            overflow-y: auto;
        }

        /* ── FORM BOX ── */
        .form-box {
            width: 100%;
            max-width: 460px;
            background: #13132a;
            border: 1px solid #1e1e3a;
            border-radius: 20px;
            padding: 2.5rem 2.2rem;
        }

        .f-heading h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
        }
        .f-heading p {
            color: rgba(255,255,255,0.4);
            font-size: 0.87rem;
            margin-top: 0.35rem;
            margin-bottom: 1.5rem;
        }

        /* Google btn */
        .btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 11px;
            background: transparent;
            border: 1px solid #1e1e3a;
            border-radius: 10px;
            color: rgba(255,255,255,0.78);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            font-family: 'Outfit', sans-serif;
            text-decoration: none;
        }
        .btn-google:hover {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.2);
            color: #fff;
        }

        /* Divider */
        .or-div {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 1rem 0;
            color: rgba(255,255,255,0.2);
            font-size: 0.76rem;
        }
        .or-div::before, .or-div::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #1e1e3a;
        }

        /* Labels */
        .fg { margin-bottom: 0.85rem; }
        .fg label {
            display: block;
            color: rgba(255,255,255,0.52);
            font-size: 0.73rem;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .name-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 0.85rem;
        }
        .name-row label {
            display: block;
            color: rgba(255,255,255,0.52);
            font-size: 0.73rem;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        /* Inputs */
        .hh-input {
            width: 100%;
            background: #0d0d1a;
            border: 1px solid #1e1e3a;
            border-radius: 10px;
            padding: 10px 14px 10px 36px;
            color: #fff;
            font-size: 0.9rem;
            font-family: 'Outfit', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .hh-input::placeholder { color: rgba(255,255,255,0.17); }
        .hh-input:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124,58,237,0.18);
        }
        .hh-input.eye-pad { padding-right: 36px; }

        .iw { position: relative; }
        .iw .fi {
            position: absolute;
            left: 11px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.2);
            font-size: 0.88rem;
            pointer-events: none;
        }
        .iw .eye-btn {
            position: absolute;
            right: 11px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.22);
            background: none;
            border: none; padding: 0;
            cursor: pointer;
            font-size: 0.9rem; line-height: 1;
        }
        .iw .eye-btn:hover { color: #a78bfa; }

        /* Role cards */
        .role-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 4px;
        }

        .role-card {
            border-radius: 12px;
            padding: 16px 14px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 6px;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
            /* Force equal height alignment */
            min-height: 110px;
            justify-content: flex-start;
        }
        .role-card input[type="radio"] { display: none; }

        .role-card.candidate-card {
            background: rgba(124,58,237,0.07);
            border: 2px solid rgba(124,58,237,0.3);
        }
        .role-card.candidate-card:hover {
            border-color: #7c3aed;
            background: rgba(124,58,237,0.13);
        }
        .role-card.candidate-card.selected {
            border-color: #7c3aed;
            background: rgba(124,58,237,0.18);
            box-shadow: 0 0 0 3px rgba(124,58,237,0.15);
        }

        .role-card.recruiter-card {
            background: rgba(167,139,250,0.05);
            border: 2px solid rgba(167,139,250,0.2);
        }
        .role-card.recruiter-card:hover {
            border-color: #a78bfa;
            background: rgba(167,139,250,0.1);
        }
        .role-card.recruiter-card.selected {
            border-color: #a78bfa;
            background: rgba(167,139,250,0.14);
            box-shadow: 0 0 0 3px rgba(167,139,250,0.12);
        }

        .role-card .check-badge {
            position: absolute;
            top: 8px; right: 8px;
            width: 18px; height: 18px;
            background: #7c3aed;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            color: #fff;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .role-card.selected .check-badge { opacity: 1; }

        .role-emoji {
            font-size: 1.5rem;
            line-height: 1;
            margin-bottom: 2px;
        }
        .role-label {
            font-size: 0.88rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }
        .role-sub {
            font-size: 0.74rem;
            color: rgba(255,255,255,0.4);
            line-height: 1;
        }

        /* Error box */
        .err-box {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 1rem;
            color: #fca5a5;
            font-size: 0.84rem;
        }
        .err-box ul { margin: 0; padding-left: 1rem; }

        /* Submit button */
        .btn-sub {
            width: 100%;
            padding: 12px;
            background: #7c3aed;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 0.97rem;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            margin-top: 1rem;
        }
        .btn-sub:hover {
            background: #5b21b6;
            box-shadow: 0 6px 20px rgba(124,58,237,0.4);
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 1.1rem;
            color: rgba(255,255,255,0.4);
            font-size: 0.84rem;
        }
        .login-link a {
            color: #a78bfa;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover { text-decoration: underline; }

        /* ── RIGHT PANEL ── */
        .right {
            flex: 1;
            min-height: 100vh;
            background: linear-gradient(135deg, #2d0a6e 0%, #4c1d95 40%, #3b0f8c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 3rem 2.5rem;
            text-align: center;
        }

        /* Glow orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.25;
            pointer-events: none;
        }
        .orb-1 {
            width: 350px; height: 350px;
            background: #a78bfa;
            top: -100px; right: -100px;
        }
        .orb-2 {
            width: 250px; height: 250px;
            background: #1e0550;
            bottom: -80px; left: -80px;
        }

        /* Stars */
        .star {
            position: absolute;
            color: rgba(255,255,255,0.8);
            animation: twinkle 3s infinite alternate;
            z-index: 2;
            pointer-events: none;
        }
        @keyframes twinkle {
            0%   { opacity: 0.2; transform: scale(1);   }
            100% { opacity: 1;   transform: scale(1.4); }
        }

        .right-content {
            position: relative;
            z-index: 3;
            max-width: 400px;
        }

        .brand-logo-row {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2.5rem;
        }
        .brand-logo-img {
            width: 46px; height: 46px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 0 24px rgba(124,58,237,0.45);
        }
        .brand-logo-text {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
        }

        .brand-headline {
            font-size: clamp(1.9rem, 2.8vw, 2.7rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .brand-headline em {
            font-style: normal;
            color: #a78bfa;
        }

        .brand-sub {
            color: rgba(255,255,255,0.38);
            font-size: 0.92rem;
            line-height: 1.7;
            margin-bottom: 2.2rem;
        }

        .brand-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }
        .brand-pill {
            background: rgba(124,58,237,0.13);
            border: 1px solid rgba(124,58,237,0.3);
            border-radius: 50px;
            padding: 6px 14px;
            font-size: 0.79rem;
            color: #a78bfa;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .right { display: none; }
            .left  { width: 100%; padding: 5rem 1.5rem 2rem; }
        }
        @media (max-width: 480px) {
            .name-row  { grid-template-columns: 1fr; }
            .role-cards { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    {{-- Home button — top right --}}
    <a href="{{ route('home') }}" class="home-btn">
        <i class="bi bi-house-fill"></i> Home
    </a>

    <div class="shell">

        {{-- ── LEFT PANEL ── --}}
        <div class="left">
            <div class="form-box">

                <div class="f-heading">
                    <h1>Create your<br>free account</h1>
                    <p>Join thousands of candidates and recruiters on HireHub.</p>
                </div>

                @if($errors->any())
                    <div class="err-box">
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Google --}}
                <a href="#" class="btn-google">
                    <svg width="17" height="17" viewBox="0 0 18 18" fill="none">
                        <path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844c-.209 1.125-.843 2.078-1.796 2.716v2.259h2.908C16.658 14.252 17.64 11.945 17.64 9.2z" fill="#4285F4"/>
                        <path d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 009 18z" fill="#34A853"/>
                        <path d="M3.964 10.71A5.41 5.41 0 013.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.996 8.996 0 000 9c0 1.452.348 2.827.957 4.042l3.007-2.332z" fill="#FBBC05"/>
                        <path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 00.957 4.958L3.964 7.29C4.672 5.163 6.656 3.58 9 3.58z" fill="#EA4335"/>
                    </svg>
                    Continue with Google
                </a>

                <div class="or-div">or register with email</div>

                <form method="POST" action="{{ route('register') }}" id="regForm">
                    @csrf
                    <input type="hidden" name="name" id="fullName">

                    {{-- Name row --}}
                    <div class="name-row">
                        <div>
                            <label>First Name</label>
                            <div class="iw">
                                <i class="bi bi-person fi"></i>
                                <input type="text" name="first_name" class="hh-input"
                                       placeholder="John"
                                       value="{{ old('first_name') }}" required>
                            </div>
                        </div>
                        <div>
                            <label>Last Name</label>
                            <div class="iw">
                                <i class="bi bi-person fi"></i>
                                <input type="text" name="last_name" class="hh-input"
                                       placeholder="Doe"
                                       value="{{ old('last_name') }}">
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="fg">
                        <label>Email Address</label>
                        <div class="iw">
                            <i class="bi bi-envelope fi"></i>
                            <input type="email" name="email" class="hh-input"
                                   placeholder="you@example.com"
                                   value="{{ old('email') }}" required>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="fg">
                        <label>Password</label>
                        <div class="iw">
                            <i class="bi bi-lock fi"></i>
                            <input type="password" name="password"
                                   id="pw1" class="hh-input eye-pad"
                                   placeholder="Min. 6 characters" required>
                            <button type="button" class="eye-btn"
                                    onclick="togglePw('pw1','e1')">
                                <i class="bi bi-eye-slash" id="e1"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="fg">
                        <label>Confirm Password</label>
                        <div class="iw">
                            <i class="bi bi-lock-fill fi"></i>
                            <input type="password" name="password_confirmation"
                                   id="pw2" class="hh-input eye-pad"
                                   placeholder="Repeat password" required>
                            <button type="button" class="eye-btn"
                                    onclick="togglePw('pw2','e2')">
                                <i class="bi bi-eye-slash" id="e2"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Role cards --}}
                    <div class="fg">
                        <label>I am joining as</label>
                        <div class="role-cards">

                            {{-- CANDIDATE --}}
                            <label class="role-card candidate-card {{ old('role','candidate') === 'candidate' ? 'selected' : '' }}"
                                   id="card-c" onclick="selectRole('candidate')">
                                <input type="radio" name="role" value="candidate"
                                       {{ old('role','candidate') === 'candidate' ? 'checked' : '' }}>
                                <div class="check-badge">
                                    <i class="bi bi-check"></i>
                                </div>
                                <div class="role-emoji">🎓</div>
                                <div class="role-label">Candidate</div>
                                <div class="role-sub">I'm looking for a job</div>
                            </label>

                            {{-- RECRUITER --}}
                            <label class="role-card recruiter-card {{ old('role') === 'recruiter' ? 'selected' : '' }}"
                                   id="card-r" onclick="selectRole('recruiter')">
                                <input type="radio" name="role" value="recruiter"
                                       {{ old('role') === 'recruiter' ? 'checked' : '' }}>
                                <div class="check-badge">
                                    <i class="bi bi-check"></i>
                                </div>
                                <div class="role-emoji">🏢</div>
                                <div class="role-label">Recruiter</div>
                                <div class="role-sub">I'm hiring talent</div>
                            </label>

                        </div>
                    </div>

                    <button type="submit" class="btn-sub">
                        Create Account &nbsp;<i class="bi bi-arrow-right"></i>
                    </button>

                </form>

                <p class="login-link">
                    Already have an account?
                    <a href="{{ route('login') }}">Log in here</a>
                </p>

            </div>
        </div>

        {{-- ── RIGHT PANEL ── --}}
        <div class="right">

            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>

            {{-- Sparkle stars --}}
            <span class="star" style="top:10%; left:10%;  font-size:1.2rem; animation-delay:0s;">✦</span>
            <span class="star" style="top:15%; right:15%; font-size:0.7rem; animation-delay:0.5s;">✦</span>
            <span class="star" style="top:50%; left:5%;   font-size:0.9rem; animation-delay:1s;">✦</span>
            <span class="star" style="top:70%; right:8%;  font-size:1.1rem; animation-delay:1.5s;">✦</span>
            <span class="star" style="bottom:15%; left:20%; font-size:0.7rem; animation-delay:0.8s;">✦</span>
            <span class="star" style="top:35%; right:5%;  font-size:0.8rem; animation-delay:0.3s;">✦</span>

            <div class="right-content">

                <div class="brand-logo-row">
                    <img src="{{ asset('assets/logo.jpg') }}"
                         alt="HireHub Logo"
                         class="brand-logo-img"
                         onerror="this.style.display='none'">
                    <span class="brand-logo-text">HireHub</span>
                </div>

                <h2 class="brand-headline">
                    Your next big<br>
                    <em>opportunity</em><br>
                    starts here.
                </h2>

                <p class="brand-sub">
                    HireHub connects talented people with the companies
                    that need them. Sign up free — no credit card, no catch.
                </p>

                <div class="brand-pills">
                    <div class="brand-pill">
                        <i class="bi bi-check-circle-fill"></i> Free forever
                    </div>
                    <div class="brand-pill">
                        <i class="bi bi-lightning-charge-fill"></i> One-click apply
                    </div>
                    <div class="brand-pill">
                        <i class="bi bi-shield-check-fill"></i> Verified recruiters
                    </div>
                    <div class="brand-pill">
                        <i class="bi bi-graph-up-arrow"></i> Track your progress
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        function togglePw(id, eyeId) {
            const el = document.getElementById(id);
            const ic = document.getElementById(eyeId);
            el.type = el.type === 'password' ? 'text' : 'password';
            ic.className = el.type === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
        }

        function selectRole(role) {
            document.getElementById('card-c').classList.toggle('selected', role === 'candidate');
            document.getElementById('card-r').classList.toggle('selected', role === 'recruiter');
            document.querySelector(`input[value="${role}"]`).checked = true;
        }

        document.getElementById('regForm').addEventListener('submit', function () {
            const f = this.querySelector('[name="first_name"]').value.trim();
            const l = this.querySelector('[name="last_name"]').value.trim();
            document.getElementById('fullName').value = (f + ' ' + l).trim();
        });
    </script>

</body>
</html>