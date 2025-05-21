<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $table = 'cashiers';
    protected $fillable = [
        'name', 'user_id', 'is_active', 'last_login_at'
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}