<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $casts = [
        'sale_date' => 'date',
    ];

    protected $fillable = ['client_id','sale_date','total','shift','subsidiary_id'];

    public function saleDetail()
    {
        return $this->hasOne('App\Models\SaleDetail', 'sale_id');
    }

    public function subsidiary()
    {
        return $this->belongsTo('App\Models\Subsidiary', 'subsidiary_id', 'id');
    }
}
