<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Especifica el nombre de la tabla si es diferente a 'products'
    protected $table = 'product';

    // Especifica los campos que pueden ser llenados masivamente
    protected $fillable = ['key', 'name', 'category', 'unit_prize', 'sell_price', 'cantidad'];
}
