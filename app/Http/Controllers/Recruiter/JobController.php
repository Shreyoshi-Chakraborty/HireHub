<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // List recruiter's jobs
    public function index()
    {
        $jobs = Auth::user()->jobs()->latest()->get();
        return view('recruiter.jobs.index', compact('jobs'));
    }

    // Show create job form
    public function create()
    {
        return view('recruiter.jobs.create');
    }

    // Store new job
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'salary'       => 'nullable|string|max:100',
            'description'  => 'required|string',
            'job_type'     => 'required|in:full-time,part-time,remote,contract',
        ]);

        Auth::user()->jobs()->create($request->all());

        return redirect()->route('recruiter.jobs.index')
            ->with('success', 'Job posted successfully!');
    }

    // Show edit form
    public function edit(Job $job)
    {
        // Make sure recruiter owns this job
        abort_if($job->recruiter_id !== Auth::id(), 403);
        return view('recruiter.jobs.edit', compact('job'));
    }

    // Update job
    public function update(Request $request, Job $job)
    {
        abort_if($job->recruiter_id !== Auth::id(), 403);

        $request->validate([
            'title'        => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'salary'       => 'nullable|string|max:100',
            'description'  => 'required|string',
            'job_type'     => 'required|in:full-time,part-time,remote,contract',
        ]);

        $job->update($request->all());

        return redirect()->route('recruiter.jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    // Delete job
    public function destroy(Job $job)
    {
        abort_if($job->recruiter_id !== Auth::id(), 403);
        $job->delete();
        return redirect()->route('recruiter.jobs.index')
            ->with('success', 'Job deleted successfully!');
    }
}