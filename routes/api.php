<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Api\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('frontend')->group(function () {
    Route::get('settings', [FrontendController::class, 'settings']);
    Route::get('payment-methods', [FrontendController::class, 'paymentMethods']);
    Route::post('track', [FrontendController::class, 'track']);
    Route::post('deposits', [FrontendController::class, 'createDeposit']);
    Route::post('payment-proof', [FrontendController::class, 'submitPaymentProof']);
    Route::get('receipt/{id}', [FrontendController::class, 'receipt']);
    Route::get('invoice/{id}', [FrontendController::class, 'invoice']);
    Route::get('printinvoice/{id}', [FrontendController::class, 'printInvoice']);
});
