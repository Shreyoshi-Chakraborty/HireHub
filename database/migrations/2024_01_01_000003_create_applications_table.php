<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // Foreign key to job
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
            // Foreign key to candidate (users table)
            $table->foreignId('candidate_id')->constrained('users')->onDelete('cascade');
            // Status: pending, reviewed, accepted, rejected
            $table->enum('status', ['pending', 'reviewed', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            // Prevent duplicate applications
            $table->unique(['job_id', 'candidate_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};