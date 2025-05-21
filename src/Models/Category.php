<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'slug', 'is_active'
    ];


    public function details()
    {
        return $this->hasMany(CategoryDetail::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

}