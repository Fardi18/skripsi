<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Penjual extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'provinces_id',
        'regencies_id',
    ];

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
}
