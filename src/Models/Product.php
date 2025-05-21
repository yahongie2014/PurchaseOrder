<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'sku', 'barcode', 'original_price', 'sale_price', 'is_sale', 'stock_quantity', 'tax_rate', 'is_taxable', 'unit', 'brand_id', 'cover_image', 'tags', 'category_id', 'synced_at', 'is_active'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}