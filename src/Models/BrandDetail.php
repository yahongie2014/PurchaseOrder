<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandDetail extends Model
{
    use HasFactory;
    protected $table = 'brand_details';

    protected $fillable = [
        'brand_id', 'locale', 'name', 'description'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
