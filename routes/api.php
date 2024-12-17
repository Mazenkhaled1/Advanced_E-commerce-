<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Dashboard\BannedController;
use App\Http\Controllers\Web\Orders\OrderController;
use App\Http\Controllers\Web\Products\ProductController;
use App\Http\Controllers\Web\Favorites\FavoriteController;
use App\Http\Controllers\Web\Categories\CategoryController;
use App\Http\Controllers\Web\Cart\CartController as CartCartController;
use App\Http\Controllers\Dashboard\Products\ProductController as ProductsProductController;
use App\Http\Controllers\Dashboard\Categories\CategoryController as CategoriesCategoryController;

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
 

Route::prefix('auth')->controller(AuthController::class)->group(function() {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/verifyOtp' , 'verifyOtp') ;
    Route::post('/logout' , 'logout')->middleware('auth:sanctum') ; 
});




Route::middleware('auth:sanctum' )->group(function() {
    Route::get('/categoriesWithProducts', [CategoryController::class , 'categoryWithProducts']);
    Route::get('/categories', [CategoryController::class , 'categories']);
    Route::get('product/{id}'  , [ProductController::class , 'singleProduct']) ; 
    Route::get('filterProducts'  , [ProductController::class , 'filterProducts']) ; 
    Route::get ('favorites' , [FavoriteController::class , 'index']) ; 
    Route::post ('addToFavorites/{productId}' , [FavoriteController::class , 'addToFavorites']) ; 
    Route::post ('removeFromFavorites/{productId}' , [FavoriteController::class , 'removeFromFavorites']) ; 
    Route::get('carts' , [CartCartController::class , 'index']);
    Route::post('addToCart/{productId}' , [CartCartController::class , 'addToCart']);
    Route::post('removeFromCart/{productId}' , [CartCartController::class  , 'removeFromCart']);
    Route::post('/checkout' , [OrderController::class  , 'checkout']) ; 
});


Route::prefix('dasboard')->group(function() {
    Route::post('/category' , [CategoriesCategoryController::class , 'store']) ; 
    Route::put('/category/{id}' , [CategoriesCategoryController::class , 'update']) ; 
    Route::delete('/category/{id}' , [CategoriesCategoryController::class , 'destroy']) ; 
    Route::post('/product' , [ProductsProductController::class , 'store']); 
    Route::put('/product/{id}' , [ProductsProductController::class , 'update']); 
    Route::delete('/product/{id}' , [ProductsProductController::class , 'destroy']); 
    Route::post('/unbanUser/{id}', [BannedController::class, 'unbanUser']);
});



route::get('/mazne' , function() {
    return 2 ; 
});