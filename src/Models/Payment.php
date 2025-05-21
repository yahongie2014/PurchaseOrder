<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'order_id', 'method', 'amount', 'reference', 'paid_at'
    ];

    protected $casts = [
        'amount' => 'float',
        'paid_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeMethod($query, $method)
    {
        return $query->where('method', $method);
    }
}
