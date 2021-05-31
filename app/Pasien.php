<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    //     'created_at' => 'datetime:d-m-Y H:i:s',
    //     'updated_at' => 'datetime:d-m-Y H:i:s',
    // ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['waktu_mulai', 'timer_count'];

    // Getters
    public function getWaktuMulaiAttribute()
    {
        return date('H:i:s', strtotime($this->attributes['created_at']));
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
    }
}
