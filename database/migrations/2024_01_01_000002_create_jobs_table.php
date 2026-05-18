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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            // Foreign key to recruiter (users table)
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('company_name');
            $table->string('location');
            $table->string('salary')->nullable();
            $table->text('description');
            // Job type: full-time, part-time, remote, contract
            $table->enum('job_type', ['full-time', 'part-time', 'remote', 'contract'])->default('full-time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};