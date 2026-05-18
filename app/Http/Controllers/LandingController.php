<?php

namespace App\Http\Controllers;

use App\Models\Job;

class LandingController extends Controller
{
    // CHANGE LANDING PAGE HERE
    public function index()
    {
        $featuredJobs = Job::latest()->take(6)->get();
        return view('landing.index', compact('featuredJobs'));
    }

    // Public jobs listing with search + location filter
    public function jobs()
    {
        $query = Job::query();

        // Filter by keyword
        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('company_name', 'like', '%' . request('search') . '%');
        }

        // Filter by location
        if (request('location')) {
            $query->where('location', 'like', '%' . request('location') . '%');
        }

        $jobs = $query->latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $hasApplied = false;
        $application = null;

        if (auth()->check() && auth()->user()->role === 'candidate') {
            $application = \App\Models\Application::where('job_id', $job->id)
                ->where('candidate_id', auth()->id())
                ->first();
            $hasApplied = (bool) $application;
        }

        return view('jobs.show', compact('job', 'hasApplied', 'application'));
    }
}