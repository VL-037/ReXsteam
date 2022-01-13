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
Route::post('/games/{gameId}', [GameController::class, 'addToCart'])->middleware('auth');
Route::get('/games/{gameId}/checkAge', [GameController::class, 'checkAgeForm']);
Route::post('/games/{gameId}/checkAge', [GameController::class, 'checkAge']);

Route::get('/admin/games', [AdminController::class, 'gameIndex'])->middleware('auth', 'role:Admin');
Route::get('/admin/games/filter', [AdminController::class, 'filterSearch'])->middleware('auth', 'role:Admin');;
Route::delete('/admin/games/{gameId}', [GameController::class, 'destroy'])->middleware('auth', 'role:Admin');;
Route::get('/admin/games/{gameId}/update', [GameController::class, 'updateForm'])->middleware('auth', 'role:Admin');;
Route::post('/admin/games/{gameId}/update', [GameController::class, 'update'])->middleware('auth', 'role:Admin');;
Route::get('/admin/games/new', [GameController::class, 'newForm'])->middleware('auth', 'role:Admin');;
Route::post('/admin/games', [GameController::class, 'new'])->middleware('auth', 'role:Admin');;

Route::get('/register', [RegistrationController::class, 'index']);
Route::post('/register', [RegistrationController::class, 'store']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');
Route::post('/profile', [UserController::class, 'updateProfile'])->middleware('auth');
Route::get('/friends', [UserController::class, 'friends'])->middleware('auth', 'role:Member');
Route::get('/transactions', [UserController::class, 'transactionHistory'])->middleware('auth', 'role:Member');

Route::get('/cart', [UserController::class, 'cart'])->middleware('auth', 'role:Member');
Route::delete('/cart', [UserController::class, 'checkout'])->middleware('auth', 'role:Member');
Route::delete('/cart/{gameId}', [UserController::class, 'destroyCartItem'])->middleware('auth', 'role:Member');
Route::get('/cart/transaction', [UserController::class, 'transactionIndex'])->middleware('auth', 'role:Member');
Route::post('/cart/transaction', [UserController::class, 'checkout'])->middleware('auth', 'role:Member');
