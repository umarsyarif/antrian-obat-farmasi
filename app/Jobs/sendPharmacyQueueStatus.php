<?php

namespace App\Jobs;

use Telegram\Bot\Actions;
use App\TelegramUser;
use Telegram\Bot\Commands\Command;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Telegram\Bot\Laravel\Facades\Telegram;

class sendPharmacyQueueStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $telegram_message;
    private $pasien;
    public function __construct($telegram_message, $pasien)
    {
        $this->telegram_message = $telegram_message;
        $this->pasien = $pasien;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $pasien = $this->pasien;
        $pasien_id = $this->pasien->id ?? $this->pasien['id'];
        $message = $this->telegram_message;
        $username = $message['message']['from']['username'];
        $first_name = $message['message']['from']['first_name'];
        $last_name = $message['message']['from']['last_name'];
        TelegramUser::updateOrCreate(
            ['chat_id' => $message['message']['from']['id']],
            [
                'pasien_id' => $pasien_id,
                'username' => $username,
                'first_name' => $first_name,
                'last_name' => $last_name,
            ]
        );

        // This will send a message using `sendMessage` method behind the scenes to
        // the user/chat id who triggered this command.
        // `replyWith<Message|Photo|Audio|Video|Voice|Document|Sticker|Location|ChatAction>()` all the available methods are dynamically
        // handled when you replace `send<Method>` with `replyWith` and use the same parameters - except chat_id does NOT need to be included in the array.
        echo "Sending message...\n";
        if (($pasien->status ?? $pasien['status']) === null) {
            Telegram::sendMessage([
                'chat_id' => $message['message']['from']['id'],
                'parse_mode' => 'HTML',
                'text' =>
                'Halo! Order obat atas nama ' . ($pasien->nama ?? $pasien['nama']) .
                    " <b>sedang dalam proses</b>.\n \n" .
                    "Anda akan diberikan notifikasi setelah order selesai di proses,\n" .
                    "Terimakasih"
            ]);
        } elseif (($pasien->status ?? $pasien['status']) == 0 || ($pasien->status ?? $pasien['status']) === true) {
            Telegram::sendMessage([
                'chat_id' => $message['message']['from']['id'],
                'parse_mode' => 'HTML',
                'text' =>
                'Halo! Order obat atas nama ' . ($pasien->nama ?? $pasien['nama']) .
                    " <b>telah selesai di proses</b>, silahkan ambil order di konter farmasi.\n \n" .
                    "\n" .
                    "Terimakasih"
            ]);
        } elseif (($pasien->status ?? $pasien['status']) === 1 || ($pasien->status ?? $pasien['status']) === false) {
            Telegram::sendMessage([
                'chat_id' => $message['message']['from']['id'],
                'parse_mode' => 'HTML',
                'text' =>
                'Halo! Order obat atas nama ' . ($pasien->nama ?? $pasien['nama']) .
                    " <b>telah selesai dan telah diterima pihak penerima pada " . $pasien->waktu_diambil . "</b>\n \n" .
                    "\n" .
                    "Terimakasih"
            ]);
        }
    }
}
