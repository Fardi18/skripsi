<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;

class Penjual extends Model
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'provinces_id',
        'regencies_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function warung()
    {
        return $this->hasOne(Warung::class);
    }

    public function rekening()
    {
        return $this->hasOne(Rekening::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinces_id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regencies_id');
    }

    public function pencairans()
    {
        return $this->hasMany(Pencairan::class);
    }
}
