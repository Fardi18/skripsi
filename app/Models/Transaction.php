<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'warung_id',
        'user_id',
        'total_price',
        'transaction_status',
        'shipping_status',
        'ongkir',
        'pajak',
        'total',
        'nama_pengirim'
    ];

    public static function mapMidtransStatus($midtransStatus)
    {
        switch ($midtransStatus) {
            case 'capture':
                return 'SUCCESS';
            case 'settlement':
                return 'SUCCESS';
            case 'pending':
                return 'PENDING';
            case 'deny':
                return 'CANCELLED';
            case 'expire':
                return 'CANCELLED';
            case 'cancel':
                return 'CANCELLED';
            default:
                return 'UNKNOWN'; // Handle any other status accordingly
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }

    public function detail_transactions()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
