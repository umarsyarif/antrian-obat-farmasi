<?php

namespace App\BotCommands;

use App\Pasien;
use App\TelegramUser;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class CheckQueueStatus extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "lihat-status-antrian";

    /**
     * @var string Command Description
     */
    protected $description = "Lihat status antrian";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        // This will update the chat status to typing...
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $message = $this->getUpdate();
        $username = $message['message']['from']['username'];
        $first_name=$message['message']['from']['first_name'],
        $last_name=$message['message']['from']['last_name'],
        TelegramUser::firstOrNew(
            ['chat_id'=>$message['message']['from']['id']],
            [
                'username'=>$username,
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                ]
        );
        $pasien_id = $this->arguments;
        $pasien = Pasien::find($pasien_id);
        
        // This will send a message using `sendMessage` method behind the scenes to
        // the user/chat id who triggered this command.
        // `replyWith<Message|Photo|Audio|Video|Voice|Document|Sticker|Location|ChatAction>()` all the available methods are dynamically
        // handled when you replace `send<Method>` with `replyWith` and use the same parameters - except chat_id does NOT need to be included in the array.
        
        if ($pasien->status === null) {
            $this->replyWithMessage(['text' => 
            'Halo! Order obat atas nama '.$pasien->nama. 
            " sedang dalam proses.\n \n". 
            "Anda akan diberikan notifikasi setelah order selesai di proses,\n". 
            "Terimakasih"
            ]);
        }elseif ($pasien->status ==1 || $pasien->status ===true) {
            $this->replyWithMessage(['text' => 
            'Halo! Order obat atas nama '.$pasien->nama. 
            " telah selesai di proses, silahkan ambil order di konter farmasi.\n \n". 
            "\n". 
            "Terimakasih"
            ]);
        }elseif ($pasien->status ===0 || $pasien->status ===false) {
            $this->replyWithMessage(['text' => 
            'Halo! Order obat atas nama '.$pasien->nama. 
            " telah selesai dan telah diterima pihak penerima pada ".$pasien->waktu_diambil"\n \n". 
            "\n". 
            "Terimakasih"
            ]);
        }
        
        

        // $this->replyWithMessage(['text' => $response]);
    }