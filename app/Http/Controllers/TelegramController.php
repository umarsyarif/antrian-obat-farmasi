<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\HttpClients\GuzzleHttpClient;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function setWebhook()
    {
        $bot_token = env('TELEGRAM_BOT_TOKEN');
        // the app url must using https protocol
        Telegram::setwebhook([
            "url" => env('APP_URL') . "/api/" . $bot_token
        ]);
        // $client = new GuzzleHttpClient();
        // $bot_token = env('TELEGRAM_BOT_TOKEN');
        // $response = $client->request('POST', 'https://api.telegram.org/bot' . $bot_token . "/setWebhook", [
        //     'form_params' => [
        //         'url' => env('APP_URL') . "/api/" . $bot_token,
        //     ]
        // ]);
        // return $response;
    }
    public function getUpdates(Request $request)
    {
        $offset = $request->offset ?? null;
        $limit = $request->limit ?? 100;
        $updates = Telegram::getUpdates(['offset' => $offset, 'limit' => $limit]);
        return (json_encode($updates));
    }
    public function getWebhookUpdates()
    {
        $update = Telegram::commandsHandler(true);
        // $updates = Telegram::getWebhookUpdates();
        return (json_encode($update));
    }
    public function removeWebhook()
    {
        Telegram::deleteWebhook();
        return 'done';
    }
}
