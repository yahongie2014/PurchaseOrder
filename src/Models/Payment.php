<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;


    protected $table = 'payments';

    protected $fillable = [
        'order_id', 'method', 'amount', 'reference', 'paid_at'
    ];

    protected $casts = [
        'amount' => 'float',
        'paid_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\PaymentFactory::new();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeMethod($query, $method)
    {
        return $query->where('method', $method);
    }
}
