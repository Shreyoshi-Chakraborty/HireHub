<?php

namespace App\Http\Controllers;

use App\Models\Job;

class LandingController extends Controller
{
    public function index()
    {
        $featuredJobs = Job::active()
            ->orderByRaw('expires_at IS NULL ASC')
            ->orderBy('expires_at', 'asc')
            ->take(6)
            ->get();

        return view('landing.index', compact('featuredJobs'));
    }

    public function jobs()
    {
        $query = Job::active();

        if (request('search')) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('company_name', 'like', '%' . request('search') . '%');
            });
        }

        if (request('location')) {
            $query->where('location', 'like', '%' . request('location') . '%');
        }

        $jobs = $query->orderByRaw('expires_at IS NULL ASC')
                      ->orderBy('expires_at', 'asc')
                      ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $hasApplied  = false;
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