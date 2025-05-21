<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'product_id', 'url', 'position', 'type'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}