<?php

use App\Http\Controllers\Admin\{AuthController,DashboardController,OrderController, UsersController,ProductController,CategoryController};
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('admin.index');

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');

Route::middleware('admin.auth')->group(function(){
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');



    Route::prefix('product')->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('admin.products');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.add');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
        //from datatable
        Route::get('/get-products', [ProductController::class, 'getProducts'])->name('admin.products.get-products');

    });

    Route::prefix('category')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.add');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
        //from datatable
        Route::get('/get-categories', [CategoryController::class, 'getCategories'])->name('admin.categories.get-categories');
    });




    Route::prefix('users')->group(function(){
        Route::get('/', [UsersController::class, 'index'])->name('admin.users');
        Route::get('/create', [UsersController::class, 'create'])->name('admin.users.add');
        Route::post('/store', [UsersController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
        Route::post('/update/{id}', [UsersController::class, 'update'])->name('admin.users.update');
        Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('admin.users.delete');
        Route::get('/profile/{id}', [UsersController::class, 'profile'])->name('admin.users.profiles');

        //from datatable
        Route::get('/get-users', [UsersController::class, 'getUsers'])->name('admin.users.get-users');
    });



    Route::prefix('order')->group(function(){
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('/{order_id}/show', [OrderController::class, 'show'])->name('admin.orders.show');

        //from datatable
        Route::get('/get-orders', [OrderController::class, 'getOrders'])->name('admin.orders.get-orders');
    });




    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});
