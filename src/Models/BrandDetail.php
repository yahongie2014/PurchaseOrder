<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class BrandDetail extends Model
{
    protected $table = 'brand_details';

    protected $fillable = [
        'brand_id', 'locale', 'name', 'description'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
