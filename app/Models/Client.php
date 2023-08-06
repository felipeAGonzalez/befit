<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $casts = [
        'birth_date' => 'date',
    ];
    protected $fillable = [ 'name','last_name','last_name_two','email','birth_date','photo',];


    public function clientDate()
    {
        return $this->hasOne('App\Models\ClientDate', 'client_id');
    }

}
