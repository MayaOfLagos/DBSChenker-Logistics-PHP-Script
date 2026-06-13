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

Route::view('/', 'app')->name('home');
Route::view('/result', 'app')->name('result');
Route::view('/deposits', 'app')->name('deposits');
Route::view('/payment', 'app')->name('payment');
Route::view('/receipt/{id?}', 'app')->whereNumber('id')->name('receipt');
Route::view('/invoice/{id}', 'app')->whereNumber('id')->name('invoice');
Route::view('/printinvoice/{id}', 'app')->whereNumber('id')->name('printinvoice');
