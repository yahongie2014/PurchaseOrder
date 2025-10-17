<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'user_id',
        'address_line',
        'city',
        'state',
        'postal_code',
        'country',
        'phone'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * (optional — add if you have date fields, JSON, etc.)
     *
     * @var array<string,string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'available_in' => 'datetime',
    ];

    /**
     * Get the user that owns this address.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
