<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubsidiaryProduct extends Model
{
    protected $table = 'subsidiary_products';

    protected $fillable = ['product_id','subsidiary_id','unit_price','sell_price','amount'];

    const PRODUCTS=[
        'product:id,key,category_id,name'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id','id');
    }
    public function subsidiary()
    {
        return $this->belongsTo('App\Models\Subsidiary', 'subsidiary_id');
    }
}




