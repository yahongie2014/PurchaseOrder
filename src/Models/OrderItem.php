<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id', 'product_id', 'product_name', 'qty', 'unit_price', 'discount_amount', 'tax_amount', 'total_price'
    ];

    protected $casts = [
        'qty' => 'integer',
        'unit_price' => 'float',
        'discount_amount' => 'float',
        'tax_amount' => 'float',
        'total_price' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getCalculatedTotalAttribute()
    {
        return ($this->unit_price * $this->qty) - $this->discount_amount + $this->tax_amount;
    }
}
