<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Candidate\DashboardController as CandidateDashboard;
use App\Http\Controllers\Candidate\ApplicationController;
use App\Http\Controllers\Recruiter\DashboardController as RecruiterDashboard;
use App\Http\Controllers\Recruiter\JobController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/jobs', [LandingController::class, 'jobs'])->name('jobs.index');
Route::get('/jobs/{job}', [LandingController::class, 'show'])->name('jobs.show');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth', 'candidate'])->prefix('candidate')->name('candidate.')->group(function () {
    Route::get('/dashboard', [CandidateDashboard::class, 'index'])->name('dashboard');
    Route::get('/profile', [CandidateDashboard::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [CandidateDashboard::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [CandidateDashboard::class, 'updateProfile'])->name('profile.update');
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('apply');
    Route::delete('/applications/{application}/withdraw', [ApplicationController::class, 'destroy'])->name('applications.withdraw');
});

Route::middleware(['auth', 'recruiter'])->prefix('recruiter')->name('recruiter.')->group(function () {
    Route::get('/dashboard', [RecruiterDashboard::class, 'index'])->name('dashboard');
    Route::get('/applicants', [RecruiterDashboard::class, 'applicants'])->name('applicants');
    Route::patch('/applicants/{application}/status', [RecruiterDashboard::class, 'updateStatus'])->name('applicants.updateStatus');
    Route::resource('jobs', JobController::class);
});