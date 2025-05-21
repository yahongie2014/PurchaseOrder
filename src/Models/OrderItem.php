<?php
namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = [
        'order_id', 'product_id', 'product_name', 'qty', 'unit_price', 'discount_amount', 'tax_amount', 'total_price'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}