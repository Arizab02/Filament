<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial_Record extends Model
{
    /** @use HasFactory<\Database\Factories\FinancialRecordFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'category', 'description', 'transaction_type', 'amount', 'transaction_date'
    ];

    public function accounting()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
