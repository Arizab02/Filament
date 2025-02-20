<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    /** @use HasFactory<\Database\Factories\DepartementFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'leader_id', 'deputy_id'
    ];

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
    
    public function deputy()
    {
        return $this->belongsTo(User::class, 'deputy_id');
    }
}
