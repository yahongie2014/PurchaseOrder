<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_details';

    protected $fillable = ['product_id', 'locale', 'name', 'description'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
