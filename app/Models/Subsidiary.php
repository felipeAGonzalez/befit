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

    public function sales()
    {
        return $this->hasMany('App\Models\Sale', 'subsidiary_id');
    }

    public function expenses()
    {
        return $this->hasMany('App\Models\Expense', 'subsidiary_id');
    }
}
