<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'login'])->name('admin.login');

//dashboard
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
