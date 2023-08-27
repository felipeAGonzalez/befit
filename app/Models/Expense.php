<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['subsidiary_id', 'user_id', 'date', 'shift', 'name', 'expenses_description', 'amount','archived'];

    protected $casts = [
        'date' => 'datetime'
    ];
    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
