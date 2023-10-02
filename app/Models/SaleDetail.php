<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;
    protected $table = 'sale_detail';

    protected $fillable = ['sale_id','product_id','service_id','amount','category','description','price'];

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale', 'sale_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }
}


