<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = [
        'product_id', 'url', 'position', 'type'
    ];

    protected $casts = [
        'position' => 'integer',
    ];

    protected static function newFactory()
    {
        return \PurchaseOrder\Database\Factories\ProductImageFactory::new();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getFullUrlAttribute()
    {
        return $this->url ? Storage::url($this->url) : null;
    }
}
