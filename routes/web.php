<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware(['auth', 'verified']);

Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create')->middleware('auth');
Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store')->middleware('auth');

Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create')->middleware('auth');
Route::post('customers', [CustomerController::class, 'store'])->name('customers.store')->middleware('auth');

Route::get('/transactions/create/{type}/{object}/{objectId}', [TransactionController::class, 'create'])->name('transactions.createFull')->middleware('auth');
Route::get('/transactions/create/{type}', [TransactionController::class, 'create'])->name('transactions.createType')->middleware('auth');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create')->middleware('auth');
