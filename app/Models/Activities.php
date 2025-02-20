<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    /** @use HasFactory<\Database\Factories\ActivitiesFactory> */
    use HasFactory;

    protected $fillable = [
        'activity_name', 'activity_date', 'description'
    ];
    
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
