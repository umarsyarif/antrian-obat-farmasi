<?php

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram as FacadesTelegram;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('bot')->group(function () {
    Route::post('/get-updates', 'TelegramController@getUpdates');
    Route::post('/' . env('TELEGRAM_BOT_TOKEN'), 'TelegramController@getWebhookUpdates')->middleware('auth');
    Route::post('/set-webhook', 'TelegramController@setWebhook');
    Route::post('/remove-webhook', 'TelegramController@removeWebhook');
});
