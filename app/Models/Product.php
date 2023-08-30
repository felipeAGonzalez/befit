<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = ['key', 'name', 'category'];

    public function sale()
    {
        return $this->hasOne('App\Models\SaleDetail', 'product_id');
    }
    public function SubsidiaryProduct()
    {
        return $this->hasMany('App\Models\SubsidiaryProduct', 'product_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
