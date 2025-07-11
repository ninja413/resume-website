<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;

Route::get('/', function () {
    return view('resume.search');
});

Route::get('/resume/show/{username}', [ResumeController::class, 'publicShow'])->name('resume.public.show');
Route::get('/resume/search', [ResumeController::class, 'search'])->name('resume.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/resume/edit', [ResumeController::class, 'edit'])->name('resume.edit');
    Route::put('/resume', [ResumeController::class, 'update'])->name('resume.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


