<?php

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

require __DIR__ . '/admin/web.php';
require __DIR__ . '/user/web.php';
require __DIR__ . '/botman.php';
require __DIR__ . '/admin/shipment.php';

// Public website (Bootstrap + logistic template CSS)
Route::view('/', 'app')->name('home');

// User portal (Tailwind-only, isolated from logistic template CSS)
Route::view('/track', 'portal')->name('track');
Route::view('/result', 'portal')->name('result');
Route::view('/deposits', 'portal')->name('deposits');
Route::view('/payment', 'portal')->name('payment');
Route::view('/receipt/{id?}', 'portal')->whereNumber('id')->name('receipt');
Route::view('/invoice/{id}', 'portal')->whereNumber('id')->name('invoice');
Route::view('/printinvoice/{id}', 'portal')->whereNumber('id')->name('printinvoice');
