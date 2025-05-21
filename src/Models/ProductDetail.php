<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_details';

    protected $fillable = ['product_id', 'locale', 'name', 'description'];

    protected static function newFactory()
    {
        return \PurchaseOrder\Database\Factories\ProductDetailFactory::new();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
