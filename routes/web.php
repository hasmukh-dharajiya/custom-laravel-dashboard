<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

Route::view('/404','error.404');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login',[AuthController::class, 'loginView'])->name('login');
Route::get('/register',[AuthController::class, 'registerView']);
Route::get('/confirm_email/{key}',[AuthController::class, 'getVerifyKey']);
Route::get('/forgot_password',[AuthController::class, 'forgotPasswordView']);
Route::get('/reset_password/{key}',[AuthController::class, 'resetPasswordEmail']);

Route::group(['prefix'=>'v1'],function (){
    Route::post('/register',[AuthController::class, 'register']);
    Route::post('/login',[AuthController::class, 'login']);
    Route::post('/forgot_password',[AuthController::class, 'forgotPassword']);
    Route::post('/reset_password',[AuthController::class, 'resetPassword']);
});

Route::group(['middleware'=>'auth'],function (){
    Route::get('/dashboard',[ProductController::class, 'getProduct']);
    Route::get('/profile',[DashboardController::class, 'profile']);
    Route::post('/update/profile',[DashboardController::class, 'profileUpdate']);
    Route::get('/logout',[AuthController::class, 'logout']);
    Route::post('/send/verify',[AuthController::class, 'sendVerifyEmail']);
    Route::get('/change_password',[UserController::class, 'changePassword']);
    Route::post('/change_password',[UserController::class, 'updatePassword']);

    Route::get('/delete/product/{id}',[ProductController::class, 'deleteProduct']);
    Route::get('/add/product',[ProductController::class, 'addProduct']);
    Route::post('/add/product',[ProductController::class, 'addNewProduct']);
});


