<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController; 
use App\Http\Controllers\SignupController; 
use App\Http\Controllers\ProductsController; 
use App\Http\Controllers\CartController; 

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

Route::get('/', [WelcomeController::class, 'homepageDisplay'])->name('homepage');
Route::get('/signup', [SignupController::class, 'signupDisplay']);
Route::post('/signup', [SignupController::class, 'create'])->name('create');
Route::get('/login', [LoginController::class, 'loginDisplay'])->name('login'); // User not logged in 
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate'); // User is logged in, call authenticate class to check credintials details 
Route::resource('/products', ProductsController::class);
Route::resource('/cart', CartController::class);
