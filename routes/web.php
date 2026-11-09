<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/actionlogin', [LoginController::class, 'login'])->name('login.action');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('page.home');
});

Route::get('/profile', [App\Http\Controllers\MahasiswaController::class, 'index']);

Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');

Route::get('/about', function () {
    return view('page.about');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    })->name('home');

    Route::resource('project', AdminProjectController::class);
});