<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'order_number', 'user_id', 'cashier_id', 'subtotal', 'discount_amount', 'tax_amount', 'total_amount', 'paid_amount', 'payment_status', 'source', 'invoice_number', 'notes'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}