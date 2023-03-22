<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\TourBaseController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\MoneyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GetController::class, 'getIndex'])->name('index');
Route::get('/profile', [GetController::class, 'getProfile'])->name('profile');
Route::get('/page/{id}', [GetController::class, 'getPage'])->name('page');
Route::get('/search', [GetController::class, 'getSearch'])->name('search');

Route::name('auth.')->group(function(){
    Route::post('/createUser', [AuthController::class, 'createUser'])->name('createUser');
    Route::post('/loginUser', [AuthController::class, 'loginUser'])->name('loginUser');
    Route::get('/logoutUser', [AuthController::class, 'logoutUser'])->name('logoutUser');
});

Route::name('admin.')->middleware('isAdmin')->group(function(){
    Route::post('/createTourBase',[TourBaseController::class, 'createTourBase'])->name('createTourBase');
    Route::get('/admin',[GetController::class, 'getAdmin'])->name('getAdmin');
});
Route::middleware('auth')->group(function(){
    Route::post('/payBooking', [GetController::class, 'payBooking'])->name('payBooking');
    Route::post('/payment', [MoneyController::class, 'payment'])->name('payment');
    Route::post('/createNewRating', [TourBaseController::class, 'createNewRating'])->name('createNewRating');
});

Route::post('/6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/webhook', [BotController::class , 'botResponse']);

Route::get('/createNewBooking/{id}/{phone}/{peoples}/{date}/{billId}', [TourBaseController::class, 'createNewBooking'])->name('createNewBooking');
