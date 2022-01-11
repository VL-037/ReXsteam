<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [GameController::class, 'index']);
Route::get('/search', [GameController::class, 'search']);
Route::get('games/{gameId}', [GameController::class, 'detail']);

Route::get('/register', [RegistrationController::class, 'index']);
Route::post('/register', [RegistrationController::class, 'store']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/cart', [UserController::class, 'cart']);
Route::delete('cart/{gameId}', [UserController::class, 'destroyCartItem']);
