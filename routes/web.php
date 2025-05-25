<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');

Route::middleware('auth:admin')->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminProjectController::class, 'index'])->name('admin.dashboard');
    Route::post('projects', [AdminProjectController::class, 'store'])->name('admin.projects.store');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
     // Προαιρετικά για edit, update, delete
    // Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    // Route::put('projects/{project}', [ProjectController::class, 'update'])->name('admin.projects.update');
    // Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
});
