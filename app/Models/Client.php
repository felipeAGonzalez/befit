<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // Especifica el nombre de la tabla si es diferente a 'clients'
    protected $table = 'client';

    // Especifica los campos que pueden ser llenados masivamente
    protected $fillable = ['key', 'name', 'category', 'unit_prize', 'sell_price', 'cantidad'];
}
