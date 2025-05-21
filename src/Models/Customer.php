<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name', 'phone', 'email'
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}