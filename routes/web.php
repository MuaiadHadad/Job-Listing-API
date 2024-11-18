<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\AuthController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/post-job', [JobListingController::class, 'store'])->name('job.store');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/browsejobs', [JobListingController::class, 'My_posts'])->middleware('auth')->name('browsejobs');
});
Route::middleware(['auth'])->group(function () {
    Route::delete('/job/{id}/delete', [JobListingController::class, 'delete'])->name('job.delete');
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/NewPost', function () {
        return view('new-post'); // Returns the browsejobs view
    })->name('NewPost');
});
Route::get('/Register', function () {
    return view('Register'); // Return the registration view
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', function () {
    return view('Login'); // Returns the login view
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/job/{id}/edit', [JobListingController::class, 'edit'])->name('job.edit');
});
Route::put('/job/{id}', [JobListingController::class, 'update'])->name('job.update');

Route::get('/', [HomeController::class, 'dashboard'])->name('home');
Route::get('/search-jobs', [HomeController::class, 'search'])->name('jobs.search');
