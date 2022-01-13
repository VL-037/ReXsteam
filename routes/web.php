<?php

use App\Http\Controllers\AdminController;
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
Route::get('/games/{gameId}', [GameController::class, 'detail']);
Route::post('/games/{gameId}', [GameController::class, 'addToCart']);
Route::get('/games/{gameId}/checkAge', [GameController::class, 'checkAgeForm']);
Route::post('/games/{gameId}/checkAge', [GameController::class, 'checkAge']);

Route::get('/admin/games', [AdminController::class, 'gameIndex']);
Route::get('/admin/games/filter', [AdminController::class, 'filterSearch']);
Route::delete('/admin/games/{gameId}', [GameController::class, 'destroy']);
Route::get('/admin/games/{gameId}/update', [GameController::class, 'updateForm']);
Route::post('/admin/games/{gameId}/update', [GameController::class, 'update']);
Route::get('/admin/games/new', [GameController::class, 'newForm']);
Route::post('/admin/games', [GameController::class, 'new']);

Route::get('/register', [RegistrationController::class, 'index']);
Route::post('/register', [RegistrationController::class, 'store']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/profile', [UserController::class, 'profile']);
Route::post('/profile', [UserController::class, 'updateProfile']);
Route::get('/friends', [UserController::class, 'friends']);

Route::get('/cart', [UserController::class, 'cart']);
Route::delete('/cart', [UserController::class, 'checkout']);
Route::delete('/cart/{gameId}', [UserController::class, 'destroyCartItem']);
Route::get('/cart/transaction', [UserController::class, 'transactionIndex']);
Route::post('/cart/transaction', [UserController::class, 'checkout']);
