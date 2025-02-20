<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /** @use HasFactory<\Database\Factories\AttechmentFactory> */
    use HasFactory;

    protected $fillable = [
        'attachmentable_id', 'attachmentable_type', 'attachment_path'
    ];
    
    public function attachmentable()
    {
        return $this->morphTo();
    }
}
