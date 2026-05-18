<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'recruiter_id',
        'title',
        'company_name',
        'location',
        'salary',
        'description',
        'job_type',
    ];

    // RELATIONSHIP: job belongsTo recruiter
    public function recruiter()
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    // RELATIONSHIP: job hasMany applications
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}