<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseDeletionRecord extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'expense_id', 'reason'];


    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
}
