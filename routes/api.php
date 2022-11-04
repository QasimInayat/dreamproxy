<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\BillingController;
use \App\Http\Controllers\CountryController;
use \App\Http\Controllers\ProvinceController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\ModemController;

Route::prefix('user')->group(function () {
    Route::middleware('guest')->post('register', [UserController::class, 'register']);
    Route::middleware('guest')->post('lostPassword', [UserController::class, 'lostPassword']);
    Route::middleware('guest')->post('confirmLostPassword', [UserController::class, 'confirmLostPassword']);
    Route::middleware('auth:api')->get('profile', [UserController::class, 'profile']);
    Route::middleware('auth:api')->post('changePassword', [UserController::class, 'changePassword']);
    Route::middleware('guest')->post('login', [UserController::class, 'login']);
    Route::middleware('auth:api')->get('listPaymentMethods', [UserController::class, 'listPaymentMethods']);
});

Route::prefix('modem')->group(function () {
    Route::middleware('auth:api')->post('changeIp', [ModemController::class, 'changeIp']);
    Route::middleware('auth:api')->get('getPublicIp', [ModemController::class, 'getPublicIp']);
    Route::middleware('auth:api')->get('list', [UserController::class, 'listModem']);
});

Route::prefix('billing')->group(function () {
    Route::middleware('auth:api')->post('save', [BillingController::class, 'save']);
    Route::middleware('auth:api')->get('get', [BillingController::class, 'get']);
});

Route::prefix('country')->group(function () {
    Route::get('list', [CountryController::class, 'list']);
});

Route::prefix('province')->group(function () {
    Route::get('list', [ProvinceController::class, 'list']);
});

Route::prefix('products')->group(function () {
    Route::get('list', [ProductController::class, 'list']);
});
