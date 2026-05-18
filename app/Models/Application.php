<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'job_id',
        'candidate_id',
        'status',
    ];

    // RELATIONSHIP: application belongsTo job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // RELATIONSHIP: application belongsTo candidate
    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}