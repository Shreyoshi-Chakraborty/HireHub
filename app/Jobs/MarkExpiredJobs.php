<?php

namespace App\Jobs;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MarkExpiredJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Retry once if it fails
    public int $tries = 1;

    public function handle(): void
    {
        // Find all jobs that have expired but haven't been flagged yet
        $expiredCount = Job::whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->count();

        Log::info("MarkExpiredJobs: {$expiredCount} expired job(s) found at " . now());

        // If you later add an `is_active` boolean column, you'd update it here.
        // For now this job logs and can be extended to send recruiter notifications,
        // hide listings from public browse, etc.
    }
}