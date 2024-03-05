<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencairan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penjual_id',
        'warung_id',
        'rekening_id',
        'status',
        'image',
        'total'
    ];

    public function penjual()
    {
        return $this->belongsTo(Penjual::class);
    }

    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }

    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }
}
