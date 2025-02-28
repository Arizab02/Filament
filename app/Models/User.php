<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'no_ktp',
        'nisn',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'generation',
        'entry_date',
        'graduate_date',
        'status_graduate',
        'class_id',
        'department_id',
        'program_stage_id',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function assessment()
    {
        return $this->hasMany(Assessment::class);
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function departement()
    {
        return $this->hasOne(Departement::class);
    }
    public function permission()
    {
        return $this->hasMany(Permission::class);
    }
    // public function santriFamiliy()
    // {
    //     return $this->hasMany(Santri_familiy::class);
    // }
    public function news()
    {
        return $this->hasMany(News::class);
    }
    public function attechmentSantri()
    {
        return $this->hasMany(Attachment_Santri::class);
    }
    public function financialRecord()
    {
        return $this->hasMany(Financial_Record::class);
    }
    // public function kelasSantri()
    // {
    //     return $this->hasMany(kelasSantri::class);
    // }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function generateCustomId($role)
    {
        $prefix = strtoupper(substr($role ? 'XX' : $role, 0, 3));
        $prefix = str_pad($prefix, 3, 'X');
        $uniqueId = Str::upper(Str::random(15));

        return $prefix . $uniqueId;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Log::info($model);
            if (empty($model->id)) {
                do {
                    $id = self::generateCustomId($model->role);
                } while (self::where('id', $id)->exists());

                $model->id = $id;
            }
        });
    }
}