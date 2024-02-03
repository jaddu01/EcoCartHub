<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'login'])->name('admin.login');
