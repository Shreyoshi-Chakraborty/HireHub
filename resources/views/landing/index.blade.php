@extends('layouts.app')
@section('title', 'Home')

@push('styles')
<style>
    /* ── CHANGE LANDING PAGE HERE ── */

    /* Hero */
    .hero-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #0d0d1a;
    }

    /* Carousel as background */
    #heroCarousel, #heroCarousel .carousel-inner,
    #heroCarousel .carousel-item {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
    }
    #heroCarousel .carousel-item img {
        width: 100%; height: 100%;
        object-fit: cover;
        opacity: 0.18;
        filter: blur(2px);
    }

    /* Violet gradient overlay */
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 60% 40%, rgba(124,58,237,0.45) 0%, rgba(13,13,26,0.92) 70%);
        z-index: 1;
    }

    /* Sparkle stars */
    .star {
        position: absolute;
        color: #fff;
        font-size: 1.2rem;
        opacity: 0.7;
        z-index: 2;
        animation: twinkle 3s infinite alternate;
    }
    @keyframes twinkle {
        0%   { opacity: 0.3; transform: scale(1);   }
        100% { opacity: 1;   transform: scale(1.3); }
    }

    /* Hero content */
    .hero-content {
        position: relative;
        z-index: 3;
        text-align: center;
        padding: 2rem 1rem;
    }
    @media (min-width: 576px) { .hero-content { padding: 2rem 2rem; } }
    @media (min-width: 992px) { .hero-content { padding: 2rem 3rem; } }

    .hero-content h1 {
        font-size: clamp(2rem, 6vw, 4.5rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
    }
    .hero-content h1 span {
        color: #a78bfa;
    }
    .hero-badge {
        display: inline-block;
        background: rgba(167,139,250,0.15);
        border: 1px solid #a78bfa;
        color: #a78bfa;
        font-size: 0.75rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        padding: 6px 18px;
        border-radius: 50px;
        margin-bottom: 1.5rem;
    }

    /* ── SEARCH BAR — responsive ── */
    .search-wrapper {
        max-width: 700px;
        margin: 2rem auto 0;
        padding: 0 0.75rem;
    }

    /* Desktop: single pill row */
    .search-bar {
        background: rgba(255,255,255,0.95);
        border-radius: 50px;
        padding: 8px 8px 8px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 8px 32px rgba(124,58,237,0.25);
    }
    .search-bar input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 0.95rem;
        flex: 1;
        min-width: 0;
        color: #1a1a2e;
    }
    .search-bar .divider {
        width: 1px;
        height: 24px;
        background: #ddd;
        flex-shrink: 0;
    }
    .search-bar button {
        background: #7c3aed;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 10px 28px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: background 0.2s;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .search-bar button:hover { background: #5b21b6; }

    /* Tablet / phone: stack inputs */
    @media (max-width: 767px) {
        .search-bar {
            flex-direction: column;
            border-radius: 20px;
            padding: 14px 16px;
            gap: 0;
            align-items: stretch;
        }
        .search-bar .input-row {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
        }
        .search-bar .input-row + .input-row {
            border-top: 1px solid #e5e7eb;
        }
        .search-bar input {
            font-size: 1rem;
            padding: 2px 0;
            width: 100%;
        }
        .search-bar .divider { display: none; }
        .search-bar button {
            border-radius: 12px;
            padding: 12px;
            font-size: 1rem;
            width: 100%;
            margin-top: 12px;
        }
    }

    /* Small phones */
    @media (max-width: 400px) {
        .search-wrapper { padding: 0 0.25rem; }
        .search-bar { padding: 12px; }
    }

    /* Section styles */
    .section-dark {
        background: #0d0d1a;
        color: #fff;
        padding: 80px 0;
    }
    .section-light {
        background: #13132a;
        color: #fff;
        padding: 80px 0;
    }
    .section-tag {
        color: #a78bfa;
        font-size: 0.8rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-weight: 600;
    }
    .section-title {
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        font-weight: 800;
        color: #fff;
        margin-top: 0.5rem;
    }

    /* Job cards */
    .job-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 24px;
        transition: all 0.3s;
        height: 100%;
    }
    .job-card:hover {
        border-color: #7c3aed;
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(124,58,237,0.2);
    }
    .job-type-badge {
        background: rgba(124,58,237,0.15);
        color: #a78bfa;
        border: 1px solid #7c3aed;
        border-radius: 50px;
        padding: 3px 14px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    /* How it works steps */
    .step-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 32px 24px;
        text-align: center;
        transition: all 0.3s;
        height: 100%;
    }
    .step-card:hover {
        border-color: #7c3aed;
        box-shadow: 0 8px 32px rgba(124,58,237,0.15);
    }
    .step-icon {
        width: 60px; height: 60px;
        background: rgba(124,58,237,0.15);
        border: 2px solid #7c3aed;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        font-size: 1.5rem;
        color: #a78bfa;
        flex-shrink: 0;
    }

    /* ── CONTACT CARDS ── */
    .contact-card {
        background: #13132a;
        border: 1px solid #1e1e3a;
        border-radius: 16px;
        padding: 28px 24px;
        height: 100%;
        transition: border-color 0.3s;
    }
    .contact-card:hover { border-color: #7c3aed; }

    /* Map container */
    .map-embed-wrapper {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #1e1e3a;
        height: 200px;
        margin-top: 20px;
    }
    @media (min-width: 768px) { .map-embed-wrapper { height: 240px; } }
    @media (min-width: 992px) { .map-embed-wrapper { height: 270px; } }

    .map-embed-wrapper iframe {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    }

    /* Placeholder shown until real iframe is added */
    .map-placeholder {
        width: 100%;
        height: 100%;
        background: #0d0d1a;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: rgba(255,255,255,0.3);
        font-size: 0.82rem;
        text-align: center;
        padding: 1rem;
    }
    .map-placeholder i { font-size: 2.2rem; color: #7c3aed; opacity: 0.45; }

    /* Footer */
    .site-footer {
        background: #080814;
        color: #aaa;
        padding: 60px 0 30px;
        border-top: 1px solid #1e1e3a;
    }
    .site-footer h5, .site-footer h6 { color: #fff; }
    .site-footer a {
        color: #aaa;
        text-decoration: none;
        transition: color 0.2s;
    }
    .site-footer a:hover { color: #a78bfa; }
    .footer-bottom {
        border-top: 1px solid #1e1e3a;
        margin-top: 40px;
        padding-top: 20px;
        text-align: center;
        font-size: 0.85rem;
    }
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════
     HERO SECTION — CHANGE LANDING PAGE HERE
════════════════════════════════════════════ --}}
<section class="hero-section">

    {{-- ╔══════════════════════════════════════════════════════╗
         ║  📌 CAROUSEL IMAGES                                 ║
         ║  Drop your 3 photos into: public/assets/carousel/   ║
         ║    slide1.jpg  /  slide2.jpg  /  slide3.jpg         ║
         ║  Recommended size: 1920×1080px landscape            ║
         ║  They appear blurred behind the hero text.          ║
         ╚══════════════════════════════════════════════════════╝ --}}
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/carousel/slide1.jpg') }}" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/carousel/slide2.jpg') }}" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/carousel/slide3.jpg') }}" alt="Slide 3">
            </div>
        </div>
    </div>

    {{-- Gradient overlay --}}
    <div class="hero-overlay"></div>

    {{-- Sparkle stars ✦ --}}
    <span class="star" style="top:12%; left:8%;  animation-delay:0s;">✦</span>
    <span class="star" style="top:20%; left:75%; animation-delay:0.5s;">✦</span>
    <span class="star" style="top:55%; left:5%;  animation-delay:1s;">✦</span>
    <span class="star" style="top:70%; left:88%; animation-delay:1.5s;">✦</span>
    <span class="star" style="top:35%; left:92%; animation-delay:0.8s; font-size:0.7rem;">✦</span>
    <span class="star" style="top:80%; left:20%; animation-delay:0.3s; font-size:0.7rem;">✦</span>

    {{-- Hero content --}}
    <div class="hero-content w-100">
        <div class="hero-badge">It's Simple and Fast</div>
        <h1>
            You deserve a job that<br>
            <span>loves</span> you back
        </h1>
        <p style="color:rgba(255,255,255,0.6); font-size:clamp(0.95rem,2.5vw,1.1rem); margin-top:1rem;">
            Need some inspiration? See what millions of people are looking for on HireHub today.
        </p>

        {{-- Responsive Search Bar --}}
        <form action="{{ route('jobs.index') }}" method="GET">
            <div class="search-wrapper">
                <div class="search-bar">

                    {{-- Keyword input --}}
                    <div class="input-row flex-grow-1">
                        <i class="bi bi-search" style="color:#888; flex-shrink:0;"></i>
                        <input type="text" name="search"
                               placeholder="Job title or Keyword"
                               value="{{ request('search') }}">
                    </div>

                    <div class="divider"></div>

                    {{-- Location input --}}
                    <div class="input-row flex-grow-1">
                        <i class="bi bi-geo-alt" style="color:#888; flex-shrink:0;"></i>
                        <input type="text" name="location"
                               placeholder="Location"
                               value="{{ request('location') }}">
                    </div>

                    <button type="submit">Search</button>
                </div>
            </div>
        </form>

    </div>
</section>

{{-- ═══════════════════════════════════════════
     FEATURED JOBS SECTION
════════════════════════════════════════════ --}}
<section class="section-dark">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag">Featured Opportunities</p>
            <h2 class="section-title">Latest Job Openings</h2>
            <p style="color:rgba(255,255,255,0.5);">
                Handpicked opportunities from top companies
            </p>
        </div>

        <div class="row g-4">
            @forelse($featuredJobs as $job)
                <div class="col-sm-6 col-lg-4">
                    <div class="job-card">
                        <div class="d-flex justify-content-between align-items-start mb-3 gap-2">
                            <h5 class="text-white fw-bold mb-0" style="line-height:1.3;">{{ $job->title }}</h5>
                            <span class="job-type-badge text-capitalize flex-shrink-0">{{ $job->job_type }}</span>
                        </div>
                        <p style="color:#a78bfa; margin-bottom:6px;">
                            <i class="bi bi-building"></i> {{ $job->company_name }}
                        </p>
                        <p style="color:rgba(255,255,255,0.5); margin-bottom:6px; font-size:0.9rem;">
                            <i class="bi bi-geo-alt"></i> {{ $job->location }}
                        </p>
                        @if($job->salary)
                            <p style="color:#34d399; font-size:0.9rem; margin-bottom:10px;">
                                <i class="bi bi-cash"></i> {{ $job->salary }}
                            </p>
                        @endif
                        <p style="color:rgba(255,255,255,0.4); font-size:0.85rem;">
                            {{ Str::limit($job->description, 80) }}
                        </p>
                        <a href="{{ route('jobs.show', $job->id) }}"
                           class="btn btn-sm mt-2 w-100"
                           style="background:rgba(124,58,237,0.15);
                                  border:1px solid #7c3aed;
                                  color:#a78bfa;
                                  border-radius:8px;">
                            View Details →
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p style="color:rgba(255,255,255,0.4);">
                        No jobs posted yet. Check back soon!
                    </p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('jobs.index') }}"
               class="btn px-5 py-3"
               style="background:#7c3aed; color:#fff;
                      border-radius:50px; font-weight:600;">
                View All Jobs <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     HOW IT WORKS SECTION
════════════════════════════════════════════ --}}
<section class="section-light" id="how-it-works">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag">How It Works</p>
            <h2 class="section-title">Easy Steps to Get Your<br>Dream Job Here</h2>
            <p style="color:rgba(255,255,255,0.5); max-width:520px; margin:1rem auto 0;">
                We ensure your next step is a step forward. Everything is simple, fast, and free.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-sm-6 col-lg-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h5 class="text-white fw-bold mb-2">Register</h5>
                    <p style="color:rgba(255,255,255,0.5); font-size:0.9rem;">
                        Create your free account as a candidate or recruiter in minutes.
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h5 class="text-white fw-bold mb-2">Find a Job</h5>
                    <p style="color:rgba(255,255,255,0.5); font-size:0.9rem;">
                        Search thousands of listings by keyword, location and job type.
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <h5 class="text-white fw-bold mb-2">Up Your Future</h5>
                    <p style="color:rgba(255,255,255,0.5); font-size:0.9rem;">
                        Apply with one click and track your applications in real time.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     ABOUT SECTION
════════════════════════════════════════════ --}}
<section class="section-dark" id="about">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <p class="section-tag">About HireHub</p>
                <h2 class="section-title">Built for Candidates.<br>Trusted by Recruiters.</h2>
                <p style="color:rgba(255,255,255,0.5); margin-top:1rem; line-height:1.8;">
                    HireHub is a modern job portal connecting talented candidates with
                    top recruiters across all industries. Whether you're just starting
                    out or looking for your next big move, we've got you covered.
                </p>
                <ul class="list-unstyled mt-3" style="color:rgba(255,255,255,0.6);">
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill me-2" style="color:#7c3aed;"></i>
                        Free to register as candidate or recruiter
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill me-2" style="color:#7c3aed;"></i>
                        Easy one-click job applications
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill me-2" style="color:#7c3aed;"></i>
                        Real-time application tracking
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill me-2" style="color:#7c3aed;"></i>
                        Trusted by hundreds of companies
                    </li>
                </ul>
                @guest
                    <a href="{{ route('register') }}"
                       class="btn mt-3 px-4 py-2"
                       style="background:#7c3aed; color:#fff; border-radius:50px; font-weight:600;">
                        Get ahead with HireHub <i class="bi bi-arrow-right"></i>
                    </a>
                @endguest
            </div>
            <div class="col-md-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="step-card text-center">
                            <h2 class="fw-bold" style="color:#a78bfa;">500+</h2>
                            <p style="color:rgba(255,255,255,0.5); margin:0;">Jobs Posted</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="step-card text-center">
                            <h2 class="fw-bold" style="color:#a78bfa;">200+</h2>
                            <p style="color:rgba(255,255,255,0.5); margin:0;">Companies</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="step-card text-center">
                            <h2 class="fw-bold" style="color:#a78bfa;">1k+</h2>
                            <p style="color:rgba(255,255,255,0.5); margin:0;">Candidates</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="step-card text-center">
                            <h2 class="fw-bold" style="color:#a78bfa;">98%</h2>
                            <p style="color:rgba(255,255,255,0.5); margin:0;">Satisfaction</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     CONTACT SECTION
════════════════════════════════════════════ --}}
<section class="section-light" id="contact">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-tag">Get In Touch</p>
            <h2 class="section-title">Contact Us</h2>
            <p style="color:rgba(255,255,255,0.5);">We'd love to hear from you</p>
        </div>

        <div class="row g-4 align-items-stretch">

            {{-- LEFT: Address + Map --}}
            <div class="col-md-6">
                <div class="contact-card d-flex flex-column">

                    {{-- Address header --}}
                    <div class="d-flex align-items-start gap-3">
                        <div class="step-icon" style="margin:0;">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <h6 class="text-white fw-bold mb-1">Address</h6>
                            <p style="color:rgba(255,255,255,0.5); font-size:0.88rem; margin:0; line-height:1.8;">
                                Scholiverse Educare Pvt. Ltd.<br>
                                901A/B, Iris Tech Park,<br>
                                Sector 48, Gurugram,<br>
                                Haryana, India - 122018
                            </p>
                        </div>
                    </div>

                    {{-- ╔══════════════════════════════════════════════════════╗
                         ║  📌 MAP EMBED — to add your Google Maps:            ║
                         ║  1. Open maps.google.com                            ║
                         ║  2. Search your address                             ║
                         ║  3. Click Share → Embed a map → Copy HTML           ║
                         ║  4. Delete the <div class="map-placeholder">        ║
                         ║     block below and paste your <iframe> in its place ║
                         ║                                                     ║
                         ║  It will look like:                                 ║
                         ║  <iframe                                            ║
                         ║    src="https://www.google.com/maps/embed?pb=..."   ║
                         ║    allowfullscreen loading="lazy"                   ║
                         ║    referrerpolicy="no-referrer-when-downgrade">     ║
                         ║  </iframe>                                          ║
                         ╚══════════════════════════════════════════════════════╝ --}}
                    <div class="map-embed-wrapper">

                        {{-- DELETE this block, paste your <iframe> here instead --}}
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3509.015311552433!2d77.03529787408472!3d28.418794843757194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d23883242f5ad%3A0xfcff2199d25c6257!2sIris%20Tech%20Park!5e0!3m2!1sen!2sin!4v1779038965124!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>

                </div>
            </div>

            {{-- RIGHT: Phone + Email + Hours stacked --}}
            <div class="col-md-6 d-flex flex-column gap-4">

                {{-- Phone --}}
                <div class="contact-card d-flex align-items-center gap-3">
                    <div class="step-icon" style="margin:0; flex-shrink:0;">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div>
                        <h6 class="text-white fw-bold mb-1">Phone</h6>
                        <p style="color:rgba(255,255,255,0.5); font-size:0.9rem; margin:0;">
                            <a href="tel:+919876543210"
                               style="color:rgba(255,255,255,0.5); text-decoration:none;">
                                +91 98765 43210
                            </a>
                        </p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="contact-card d-flex align-items-center gap-3">
                    <div class="step-icon" style="margin:0; flex-shrink:0;">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div>
                        <h6 class="text-white fw-bold mb-1">Email</h6>
                        <p style="color:rgba(255,255,255,0.5); font-size:0.9rem; margin:0;">
                            <a href="mailto:hello@hirehub.in"
                               style="color:#a78bfa; text-decoration:none;">
                                hello@hirehub.in
                            </a>
                        </p>
                    </div>
                </div>

                {{-- Business Hours --}}
                <div class="contact-card d-flex align-items-center gap-3">
                    <div class="step-icon" style="margin:0; flex-shrink:0;">
                        <i class="bi bi-clock"></i>
                    </div>
                    <div>
                        <h6 class="text-white fw-bold mb-1">Business Hours</h6>
                        <p style="color:rgba(255,255,255,0.5); font-size:0.88rem; margin:0; line-height:1.8;">
                            Mon – Fri: 9:00 AM – 6:00 PM IST<br>
                            Sat: 10:00 AM – 2:00 PM IST
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     FOOTER
════════════════════════════════════════════ --}}
<footer class="site-footer">
    <div class="container">
        <div class="row g-5">

            {{-- Brand --}}
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    {{-- 📌 LOGO: same file as navbar — public/assets/logo.jpg --}}
                    <img src="{{ asset('assets/logo.jpg') }}"
                         style="height:32px; width:32px; border-radius:6px; object-fit:cover;"
                         onerror="this.style.display='none'" alt="logo">
                    <span style="color:#fff; font-weight:700; font-size:1.3rem;">
                        Hire<span style="color:#a78bfa;">Hub</span>
                    </span>
                </div>
                <p style="font-size:0.9rem; line-height:1.7;">
                    Your gateway to the best career opportunities.
                    Connecting talent with top companies across India.
                </p>
            </div>

            {{-- Quick Links --}}
            <div class="col-6 col-md-2">
                <h6 class="mb-3">Quick Links</h6>
                <ul class="list-unstyled" style="font-size:0.9rem;">
                    <li class="mb-2"><a href="{{ route('home') }}">Home</a></li>
                    <li class="mb-2"><a href="{{ route('home') }}#about">About</a></li>
                    <li class="mb-2"><a href="{{ route('home') }}#how-it-works">How It Works</a></li>
                    <li class="mb-2"><a href="{{ route('jobs.index') }}">Browse Jobs</a></li>
                    <li class="mb-2"><a href="{{ route('home') }}#contact">Contact</a></li>
                </ul>
            </div>

            {{-- For Users --}}
            <div class="col-6 col-md-2">
                <h6 class="mb-3">For Users</h6>
                <ul class="list-unstyled" style="font-size:0.9rem;">
                    <li class="mb-2"><a href="{{ route('register') }}">Register</a></li>
                    <li class="mb-2"><a href="{{ route('login') }}">Login</a></li>
                    <li class="mb-2"><a href="#">Privacy Policy</a></li>
                    <li class="mb-2"><a href="#">Terms of Use</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-md-4">
                <h6 class="mb-3">Contact</h6>
                <ul class="list-unstyled" style="font-size:0.88rem; line-height:1.8;">
                    <li>
                        <i class="bi bi-geo-alt me-2" style="color:#7c3aed;"></i>
                        901A/B, Iris Tech Park, Sector 48,<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gurugram, Haryana - 122018
                    </li>
                    <li class="mt-2">
                        <i class="bi bi-telephone me-2" style="color:#7c3aed;"></i>
                        +91 98765 43210
                    </li>
                    <li class="mt-2">
                        <i class="bi bi-envelope me-2" style="color:#7c3aed;"></i>
                        hello@hirehub.in
                    </li>
                </ul>
            </div>

        </div>

        {{-- Footer bottom --}}
        <div class="footer-bottom">
            <p class="mb-0" style="color:rgba(255,255,255,0.3);">
                © 2026 HireHub Pvt. Ltd. — Scholiverse Educare Pvt. Ltd. All rights reserved.
            </p>
        </div>

    </div>
</footer>

@endsection