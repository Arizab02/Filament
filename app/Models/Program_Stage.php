<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_Stage extends Model
{
    /** @use HasFactory<\Database\Factories\EducationStageFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];
}
