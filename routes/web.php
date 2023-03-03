<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/daftar-produk', [ProductController::class, 'getProduct']);
Route::get('/insert-produk', [ProductController::class, 'insertProduct']);

Route::get('/daftar-user', [UserController::class, 'getUser']);
Route::get('/insert-user', [UserController::class, 'insertUser']);

Route::get('/daftar-transaksi', [TransactionController::class, 'getTransaction']);
Route::get('/insert-transaksi', [TransactionController::class, 'insertTransaction']);