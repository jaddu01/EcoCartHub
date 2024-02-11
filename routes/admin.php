<?php

use App\Http\Controllers\Admin\{AuthController,DashboardController, UsersController,ProductController,CategoryController};
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('admin.index');

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');

Route::middleware('admin.auth')->group(function(){
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');



    Route::prefix('product')->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('admin.products');
    });

    Route::prefix('category')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
    });



    Route::prefix('users')->group(function(){
        Route::get('/', [UsersController::class, 'index'])->name('admin.users');
        // Route::get('/create', [UsersController::class, 'create'])->name('admin.users.create');
        // Route::post('/store', [UsersController::class, 'store'])->name('admin.users.store');
        // Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
        // Route::post('/update/{id}', [UsersController::class, 'update'])->name('admin.users.update');
        // Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('admin.users.delete');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});
