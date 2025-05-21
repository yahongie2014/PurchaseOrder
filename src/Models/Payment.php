<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'order_id', 'method', 'amount', 'reference', 'paid_at'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}