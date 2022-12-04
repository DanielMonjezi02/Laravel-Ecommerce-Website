<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController; 
use App\Http\Controllers\SignupController; 
use App\Http\Controllers\ProductsController; 
use App\Http\Controllers\CartController; 
use App\Http\Controllers\AccountController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [WelcomeController::class, 'homepageDisplay'])->name('homepage');
Route::get('/signup', [SignupController::class, 'signupDisplay']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/account', [AccountController::class, 'displayAccountSettings']);
Route::get('/recoveryLogin', [LoginController::class, 'recoveryLogin'])->name('recoveryLogin');
Route::post('/signup', [SignupController::class, 'create'])->name('create'); 
Route::post('/cart/add/{product}', [CartController::class, 'addProductToCart'])->name('addProductToCart');
Route::resource('/products', ProductsController::class);
Route::resource('/cart', CartController::class);
