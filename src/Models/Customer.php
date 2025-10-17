<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password'
    ];

    protected $casts = [
        'phone' => 'string',
        'email' => 'string',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\CustomerFactory::new();
    }

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
