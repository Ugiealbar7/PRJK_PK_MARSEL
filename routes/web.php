<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Back\ProjectController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\ProgressController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Front\PublicProjectController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Front\FrontProgressController;

/*
|--------------------------------------------------------------------------
| ROUTE HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Project publik
Route::prefix('public')->group(function () {
    Route::get('/projects', [PublicProjectController::class, 'index'])->name('public.projects.index');
    Route::get('/projects/mingguan', [PublicProjectController::class, 'weekly'])->name('public.projects.weekly');
    Route::get('/projects/arsip', [PublicProjectController::class, 'archive'])->name('public.projects.archive');
    Route::get('/projects/{slug}', [PublicProjectController::class, 'show'])->name('public.projects.show');

    // Progress publik
    Route::prefix('progress')->group(function () {
        Route::get('/weekly', [FrontProgressController::class, 'weekly'])->name('public.progress.weekly');
        Route::get('/{id}', [FrontProgressController::class, 'show'])->name('public.progress.show');
    });
});

Route::view('/tentang-kami', 'front.about')->name('about');
Route::view('/layanan', 'front.services')->name('public.services');

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN (AUTH TANPA PREFIX)
|--------------------------------------------------------------------------
*/

// Login & Logout Admin
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Route yang butuh login admin
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Project
    Route::resource('/projects', ProjectController::class);

    // CRUD Kategori
    Route::resource('/categories', CategoryController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);

    // Progress terkait project
    Route::prefix('/projects/{project}/progress')->group(function () {
        Route::get('/', [ProgressController::class, 'index'])->name('progress.index');
        Route::get('/create', [ProgressController::class, 'create'])->name('progress.create');
        Route::post('/', [ProgressController::class, 'store'])->name('progress.store');
    });

    // Progress detail/edit
    Route::prefix('/progress')->group(function () {
        Route::get('/{progress}', [ProgressController::class, 'show'])->name('progress.show');
        Route::get('/{progress}/edit', [ProgressController::class, 'edit'])->name('progress.edit');
        Route::put('/{progress}', [ProgressController::class, 'update'])->name('progress.update');
        Route::delete('/{progress}', [ProgressController::class, 'destroy'])->name('progress.destroy');
    });
});
