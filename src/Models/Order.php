<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use PurchaseOrder\Events\OrderUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $dispatchesEvents = [
        'updated' => OrderUpdated::class,
    ];

    protected $fillable = [
        'order_number', 'user_id', 'cashier_id', 'customer_id', 'subtotal',
        'discount_amount', 'tax_amount', 'total_amount', 'paid_amount',
        'payment_status', 'source', 'invoice_number', 'notes'
    ];

    protected $casts = [
        'subtotal' => 'float',
        'discount_amount' => 'float',
        'tax_amount' => 'float',
        'total_amount' => 'float',
        'paid_amount' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\OrderFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }

    // ADD THIS:
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

    public function scopePaymentStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }

    public function getIsPaidAttribute()
    {
        return $this->payment_status === 'paid';
    }
}
