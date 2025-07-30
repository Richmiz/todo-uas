<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// New landing page route
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Dashboard route (requires authentication)
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
});