<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestEmail;

use App\Http\Controllers\BinanceController;
use App\Http\Controllers\SubscriptionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/rate', [BinanceController::class, 'showRate']);

Route::post('/subscribe', [SubscriptionController::class, 'subscribeEmail']);

Route::post('/sendEmails', [SubscriptionController::class, 'notifySubscribers']);
