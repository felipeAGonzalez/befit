<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{

    protected $table = 'subsidiary';

    protected $fillable = [
        'name', 'address', 'logo', 'zip_code', 'phone_number',
    ];

    public function subsidiaryProducts()
    {
        return $this->hasMany(SubsidiaryProduct::class);
    }
}
