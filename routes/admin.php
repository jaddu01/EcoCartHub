<?php

use App\Http\Controllers\Admin\{AuthController,DashboardController};
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('admin.index');

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/users',function(){
    return view('admin.users');
})->name('admin.user');

Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
