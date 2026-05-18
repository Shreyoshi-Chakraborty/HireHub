<?php

namespace App\Console\Commands;

use App\Jobs\MarkExpiredJobs;
use Illuminate\Console\Command;

class DispatchExpiredJobsCheck extends Command
{
    protected $signature   = 'jobs:check-expired';
    protected $description = 'Dispatch the MarkExpiredJobs queue job to flag expired listings';

    public function handle(): void
    {
        MarkExpiredJobs::dispatch();
        $this->info('MarkExpiredJobs dispatched to queue.');
    }
}