<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireHub — @yield('title', 'Find Your Dream Job')</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Outfit Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --violet:       #7c3aed;
            --violet-dark:  #5b21b6;
            --violet-light: #a78bfa;
            --dark-bg:      #0d0d1a;
            --dark-card:    #13132a;
            --dark-border:  #1e1e3a;
        }

        /* Base */
        body {
            background-color: #0d0d1a;
            font-family: 'Outfit', sans-serif;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            min-height: 100vh;
            background-color: #13132a;
            border-right: 1px solid #1e1e3a;
        }
        .sidebar a {
            color: #a78bfa;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #7c3aed;
            color: #fff;
        }
        .sidebar .nav-header {
            color: #6c757d;
            font-size: 11px;
            text-transform: uppercase;
            padding: 10px 15px;
            letter-spacing: 1px;
        }

        /* ── TOP NAVBAR (dashboard pages) ── */
        .top-navbar {
            background-color: #13132a;
            border-bottom: 1px solid #1e1e3a;
        }
        .top-navbar .navbar-brand {
            color: #fff;
            font-weight: 700;
            font-size: 1.5rem;
        }
        .top-navbar .nav-link {
            color: rgba(255,255,255,0.85);
        }
        .top-navbar .nav-link:hover {
            color: #a78bfa;
        }

        /* ── CARDS ── */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .stat-card {
            border-left: 4px solid #7c3aed;
        }

        /* ── BUTTONS ── */
        .btn-violet {
            background-color: #7c3aed;
            color: #fff;
            border: none;
        }
        .btn-violet:hover {
            background-color: #5b21b6;
            color: #fff;
        }

        /* ── ALERTS ── */
        .alert {
            border-radius: 10px;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- CHANGE NAVBAR HERE --}}
    @include('layouts.navbar')

    <div class="container-fluid px-0">
        <div class="row g-0" style="align-items:stretch; min-height:100%;">

            @auth
                <div class="col-md-2 px-0" style="background:#13132a; border-right:1px solid #1e1e3a;">
                    @include('layouts.sidebar')
                </div>
                <div class="col-md-10 p-0">
            @else
                <div class="col-12 p-0">
            @endauth

                    {{-- Flash messages --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mx-4 mt-3">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mx-4 mt-3">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Page content --}}
                    @yield('content')

                </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>