<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\sendPharmacyQueueStatus;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'waktu_selesai',
        'waktu_diambil',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //     'created_at' => 'datetime:d F Y',
    // ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['waktu_mulai', 'timer_count', 'terlambat'];

    // Getters
    public function getWaktuMulaiAttribute()
    {
        return date('H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getTerlambatAttribute()
    {
        $start = $this->attributes['created_at'];
        $end = $this->attributes['waktu_selesai'];
        $diff =  Carbon::parse($start)->diffInSeconds($end);
        return $diff > 3600 ? gmdate('H:i:s', $diff - 3600) : '-';
    }

    public function getTimerCountAttribute()
    {
        return null;
    }

    // Setters
    public function setStatusAttribute($value)
    {
        $now = now();
        if ($value) {
            $this->attributes['waktu_diambil'] = $now;
        } else {
            $this->attributes['waktu_selesai'] = $now;
        }
        $this->attributes['status'] = $value;
        $telegram_user = $this->telegram_user()->get();
        foreach ($telegram_user as $key => $value) {
            $message = [
                "message" => [
                    "from" => [
                        "username" => $value['username'],
                        'first_name' => $value['first_name'],
                        'last_name' => $value['last_name'],
                        'id' => $value['chat_id'],
                    ]
                ]
            ];
            $process = new sendPharmacyQueueStatus($message, $this->attributes);
            dispatch($process);
        }
    }

    public function telegram_user()
    {
        return $this->hasMany('App\TelegramUser');
    }
}
