<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $fillable = ['client_id','sale_date','total',];

    public function saleDetail()
    {
        return $this->hasOne('App\Models\SaleDetail', 'sale_id');
    }
}
