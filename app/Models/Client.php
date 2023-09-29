<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';

    protected $casts = [
        'birth_date' => 'date',
    ];
    protected $fillable = [ 'subsidiary_id','name','last_name','last_name_two','email','birth_date','phone_number','photo',];


    public function clientDate()
    {
        return $this->hasOne('App\Models\ClientDate', 'client_id');
    }

}
