<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubmissionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/requirements', function () {
        return view('requirements');
    })->name('requirements');

    Route::resource('students', StudentsController::class);
    Route::resource('submissions', SubmissionsController::class);
    Route::get('/submissions/type/{type}', [SubmissionsController::class, 'byType'])->name('submissions.byType');
});
