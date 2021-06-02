<?php

namespace App\Console\Commands;

use App\Jobs\sendPharmacyQueueStatus;
use App\Pasien;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Cache;
use Telegram\Bot\Laravel\Facades\Telegram;

class startTelegramBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'startTelegramBot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Running telegram messages listener...\n";


        while (true) {
            $offset = $this->getPreviousUpdateID();
            $this->processMessages($offset);
            sleep(1);
        }
    }
    public function processMessages($offset = null, $limit = 100)
    {
        $updates = Telegram::getUpdates(['offset' => $offset, 'limit' => $limit]);
        echo "messages count: " . count($updates) . "\n";
        foreach ($updates as $key => $value) {
            echo "update id : " . $value["update_id"] . " ";
            if ($value["update_id"] == $offset) continue;
            $this->setPreviousUpdateID($value["update_id"]);
            $text = explode(" ", $value['message']['text']);
            if ($text[0] != "/lihat-status-antrian") continue;
            if (!$text[1]) continue;

            $pasien = Pasien::find($text[1]);
            if (!$pasien) {
                Telegram::sendMessage([
                    'chat_id' => $value['message']['from']['id'],
                    'parse_mode' => 'HTML',
                    'text' =>
                    "Maaf, kami tidak dapat menemukan antrian anda \n"
                ]);
                continue;
            }
            echo "Adding sendPharmacyQueueStatus job to queue...\n";
            $process = new sendPharmacyQueueStatus($value, $pasien);
            dispatch($process);
        }
    }
    public function getPreviousUpdateID()
    {
        echo "checking update id...\n";
        if (Cache::has('previous_update_id')) {
            echo "update id exist!\n\n";
            return Cache::get('previous_update_id');
        }
        echo "update id doesnt exist!\n\n";
        return null;
    }
    public function setPreviousUpdateID($id)
    {
        Cache::forever('previous_update_id', $id);
        echo "setting update id to " . $id . "\n";
    }
}
