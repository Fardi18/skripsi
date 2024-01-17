<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warung extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "location",
        "image",
        "description",
        "address",
        "penjual_id",
    ];

    public function penjual()
    {
        return $this->belongsTo(Penjual::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
