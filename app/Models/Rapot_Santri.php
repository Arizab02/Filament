<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapot_Santri extends Model
{
    /** @use HasFactory<\Database\Factories\RapotSantriFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'academic_year', 'overall_score', 'strengths', 'weaknesses'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
