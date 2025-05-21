<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id', 'url', 'position', 'type'
    ];

    protected $casts = [
        'position' => 'integer',
    ];

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
