<?php

use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/admin/projects/create', [AdminProjectController::class, 'create'])->name('admin.projects.create');
Route::post('/admin/projects', [AdminProjectController::class, 'store'])->name('admin.projects.store');
