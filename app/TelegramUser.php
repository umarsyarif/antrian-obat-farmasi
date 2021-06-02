<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    protected $fillable = [
        'chat_id',
        'pasien_id',
        'username',
        'first_name',
        'last_name',
    ];
}
