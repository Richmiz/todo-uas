<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Auth::routes();



Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
});