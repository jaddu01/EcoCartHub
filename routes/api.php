<?php
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', [AuthController::class, 'index']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

// //products
// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/productInfo', [ProductController::class, 'productInfo']);

//users
// Route::get('/users/getUsers',[UserController::class,'index']);
// Route::get('/users/getUser/{userId}', [UserController::class, 'getUserById']);
// Route::get('/users/usersAddresses',[UserController::class,'usersWithAddresses']);

//groups
Route::prefix('users')->group(function(){
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{userId}', [UserController::class, 'getUserById']);
    Route::get('/{user_id}/addresses', [UserController::class, 'usersWithAddresses']);
});

Route::prefix('products')->group(function(){
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{product_id}', [ProductController::class, 'details']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::post('{product_id}/update', [ProductController::class, 'update']);
    Route::delete('{product_id}/delete', [ProductController::class, 'delete']);

    //show deleted products
    Route::get('/deleted/all', [ProductController::class, 'showDeletedProducts']);
});


Route::prefix('category')->group(function(){
    Route::get('/',[CategoryController::class,'index']);
    Route::get('/{category_id}', [CategoryController::class, 'details']);
    Route::post('store',[CategoryController::class,'store']);
    Route::post('{category_id}/update', [CategoryController::class, 'update']);
    Route::delete('{category_id}/delete',[CategoryController::class,'delete']);
    Route::get('/deleted/all',[CategoryController::class, 'showDeletedCategories']);

});
