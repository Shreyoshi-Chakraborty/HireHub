<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalJobs = $user->jobs()->count();
        $activeJobs = $user->jobs()->active()->count();

        $expiringSoon = $user->jobs()
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', now())
            ->where('expires_at', '<=', now()->addDays(5))
            ->count();

        $expiredJobs = $user->jobs()->expired()->count();

        $totalApplicants = Application::whereIn(
            'job_id',
            $user->jobs()->pluck('id')
        )->count();

        $recentJobs = $user->jobs()->latest()->take(5)->get();

        return view('recruiter.dashboard', compact(
            'user',
            'totalJobs',
            'activeJobs',
            'expiringSoon',
            'expiredJobs',
            'totalApplicants',
            'recentJobs'
        ));
    }

    public function applicants()
    {
        $user = Auth::user();
        $applications = Application::whereIn(
            'job_id',
            $user->jobs()->pluck('id')
        )->with(['job', 'candidate'])->latest()->get();

        return view('recruiter.applicants', compact('applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected,pending',
        ]);

        // Make sure this application belongs to the recruiter's job
        $jobIds = Auth::user()->jobs()->pluck('id');
        if (!$jobIds->contains($application->job_id)) {
            return back()->with('error', 'Unauthorized action.');
        }

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated.');
    }
}