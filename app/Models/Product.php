<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Especifica el nombre de la tabla si es diferente a 'products'
    protected $table = 'product';

    // Especifica los campos que pueden ser llenados masivamente
    protected $fillable = ['key', 'name', 'category', 'unit_prize', 'sell_price', 'cantidad'];

    public function sale()
    {
        return $this->hasOne('App\Models\SaleDetail', 'product_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
