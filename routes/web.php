<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\FeedbackController;

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

Route::get('login', [LoginController::class, 'show'])->name('login.show');
Route::post('login', [LoginController::class, 'check'])->name('login.check');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard');
    Route::prefix('feedback')->group(function () {
        Route::get('', [FeedbackController::class, 'getList'])->name('feedback');
        Route::post('reply', [FeedbackController::class, 'reply'])->name('feedback.reply');
        Route::get('reply-list', [FeedbackController::class, 'getReplyList'])->name('feedback.replyList');
    });
});
