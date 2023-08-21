<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;
    protected $table = 'sale_detail';

    protected $fillable = ['sale_id','product_id','service_id','amount','category','description','price'];
}


