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
        'expires_at',   // added
    ];

    protected $casts = [
        'expires_at' => 'datetime',  // auto-cast to Carbon
    ];

    // Belongs to a recruiter (user)
    public function recruiter()
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    // Has many applications
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    // Scope: only active (not expired) jobs
    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }

    // Scope: only expired jobs
    public function scopeExpired($query)
    {
        return $query->whereNotNull('expires_at')
                     ->where('expires_at', '<=', now());
    }

    // Helper
    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }
}