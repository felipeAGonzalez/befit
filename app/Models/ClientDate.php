<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDate extends Model
{
    protected $table = 'client_date';

    protected $casts = [
        'date_entry' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $fillable = ['client_id','date_entry','start_date','end_date'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
}
