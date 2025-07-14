<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Back\ProjectController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\ProgressController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Front\PublicProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/public/projects', [PublicProjectController::class, 'index'])->name('public.projects.index');
Route::get('/public/projects/{slug}', [PublicProjectController::class, 'show'])->name('public.projects.show');



Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('projects', ProjectController::class);

Route::resource('/categories', CategoryController::class)->only([
    'index',
    'store',
    'update',
    'destroy'
]);

Route::get('/projects/{project}/progress', [ProgressController::class, 'index'])->name('progress.index');

Route::get('/projects/{project}/progress/create', [ProgressController::class, 'create'])->name('progress.create');
Route::post('/projects/{project}/progress', [ProgressController::class, 'store'])->name('progress.store');
Route::get('/progress/{progress}', [ProgressController::class, 'show'])->name('progress.show');
Route::get('/progress/{progress}/edit', [ProgressController::class, 'edit'])->name('progress.edit');
Route::put('/progress/{progress}', [ProgressController::class, 'update'])->name('progress.update');
Route::delete('/progress/{progress}', [ProgressController::class, 'destroy'])->name('progress.destroy');
