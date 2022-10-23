<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\BuyerTransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffTransactionController;
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

Route::get('/', [HomeController::class, 'viewHome'])->name('home')->middleware('auth');
Route::get('/login', [LoginController::class, 'viewLogin'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');


Route::middleware('auth')->group(function () {
    Route::resource('items', ItemController::class)->except(['show']);
    Route::resource('buyers', BuyerController::class);

    Route::prefix('staff/transaction')->group(function () {
        Route::get('/', [StaffTransactionController::class, 'index'])->name('staff.transaction.index');
        Route::post('/approve/{id}', [StaffTransactionController::class, 'approve'])->name('staff.transaction.approve');
        Route::post('/reject/{id}', [StaffTransactionController::class, 'reject'])->name('staff.transaction.reject');
    });

    Route::prefix('buyer/transaction')->group(function () {
        Route::get('/', [BuyerTransactionController::class, 'index'])->name('buyer.transaction.index');
        Route::get('/cart', [BuyerTransactionController::class, 'create'])->name('buyer.transaction.cart');
        Route::post('/addCart/{id}', [BuyerTransactionController::class, 'addCart'])->name('buyer.transaction.addCart');
        Route::post('/submitCart', [BuyerTransactionController::class, 'submitCart'])->name('buyer.transaction.submitCart');
    });
});
