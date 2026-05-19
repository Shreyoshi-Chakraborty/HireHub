<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Auto-delete expired jobs for this recruiter
        $user->jobs()->expired()->delete();

        $jobs = $user->jobs()->latest()->paginate(10);
        return view('recruiter.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('recruiter.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'salary'       => 'nullable|string|max:100',
            'description'  => 'required|string',
            'job_type'     => 'required|in:full-time,part-time,remote,contract',
            'expires_at'   => 'nullable|date|after:today',
        ]);

        Auth::user()->jobs()->create($request->only([
            'title', 'company_name', 'location',
            'salary', 'description', 'job_type', 'expires_at',
        ]));

        return redirect()->route('recruiter.jobs.index')
            ->with('success', 'Job posted successfully!');
    }

    public function edit(Job $job)
    {
        abort_if($job->recruiter_id !== Auth::id(), 403);
        return view('recruiter.jobs.edit', compact('job'));
    }

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
            'expires_at'   => 'nullable|date',
        ]);

        $job->update($request->only([
            'title', 'company_name', 'location',
            'salary', 'description', 'job_type', 'expires_at',
        ]));

        return redirect()->route('recruiter.jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        abort_if($job->recruiter_id !== Auth::id(), 403);
        $job->delete();
        return redirect()->route('recruiter.jobs.index')
            ->with('success', 'Job deleted successfully!');
    }
}