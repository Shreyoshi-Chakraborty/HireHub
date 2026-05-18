<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Recruiter dashboard
    public function index()
    {
        $user = Auth::user();
        // Total jobs posted by this recruiter
        $totalJobs = $user->jobs()->count();
        // Total applicants across all recruiter's jobs
        $totalApplicants = Application::whereIn(
            'job_id',
            $user->jobs()->pluck('id')
        )->count();

        return view('recruiter.dashboard', compact('user', 'totalJobs', 'totalApplicants'));
    }

    // View all applicants for recruiter's jobs
    public function applicants()
    {
        $user = Auth::user();
        $applications = Application::whereIn(
            'job_id',
            $user->jobs()->pluck('id')
        )->with(['job', 'candidate'])->latest()->get();

        return view('recruiter.applicants', compact('applications'));
    }
}