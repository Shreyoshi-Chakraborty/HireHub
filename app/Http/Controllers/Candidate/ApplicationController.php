<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // List all applications by this candidate
    public function index()
    {
        $applications = Auth::user()
            ->applications()
            ->with('job')
            ->latest()
            ->get();

        return view('candidate.applications', compact('applications'));
    }

    // Withdraw an application
    public function destroy(Application $application)
    {
        // Only the owner can withdraw
        if ($application->candidate_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $application->delete();
        return redirect()->route('candidate.applications')
                         ->with('success', 'Application withdrawn successfully.');
    }

    // Apply for a job
    public function apply(Job $job)
    {
        $candidateId = Auth::id();

        // Prevent duplicate applications
        $alreadyApplied = Application::where('job_id', $job->id)
            ->where('candidate_id', $candidateId)
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'You have already applied for this job.');
        }

        // Create application
        Application::create([
            'job_id'       => $job->id,
            'candidate_id' => $candidateId,
            'status'       => 'pending',
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }
}