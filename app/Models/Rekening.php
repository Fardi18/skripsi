<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'name',
        'bank_number',
        'penjual_id',
    ];

    public function penjual()
    {
        return $this->belongsTo(Penjual::class);
    }
}
