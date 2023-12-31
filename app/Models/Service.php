<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['key', 'name', 'category', 'days','price'];

    public function sale()
    {
        return $this->hasOne('App\Models\SaleDetail', 'service_id');
    }
}
