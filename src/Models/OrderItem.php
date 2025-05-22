<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

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


    protected static function newFactory()
    {
        return \Database\Factories\OrderItemFactory::new();
    }

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
