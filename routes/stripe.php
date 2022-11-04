<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StripeController;

Route::prefix('stripe')->middleware('stripe')->any('webhook', [StripeController::class, 'handle']);
