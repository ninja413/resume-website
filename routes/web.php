<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('resume.search');
});

Route::get('/resume/show/{username}', [ResumeController::class, 'show'])->name('resume.show');
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

    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::post('/upload-image', [BlogController::class, 'uploadImage'])->name('blog.uploadImage');
});

require __DIR__.'/auth.php';

Route::get('/blog/index/{username}', [BlogController::class, 'indexPublic'])->name('blog.public.index');
Route::get('/blog/{username}/{id}', [BlogController::class, 'showPublic'])->name('blog.public.show');

