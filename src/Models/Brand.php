<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = [
        'slug', 'logo', 'is_active'
    ];


    public function details()
    {
        return $this->hasMany(BrandDetail::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

}