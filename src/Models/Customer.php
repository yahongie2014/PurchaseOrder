<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'name', 'phone', 'email'
    ];

    protected $casts = [
        'phone' => 'string',
        'email' => 'string',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeByPhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email);
    }
}
