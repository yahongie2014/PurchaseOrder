<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandDetail extends Model
{
    use HasFactory;

    protected $table = 'brand_details';

    protected $fillable = [
        'brand_id', 'locale', 'name', 'description'
    ];

    protected static function newFactory()
    {
        return \Database\Factories\BrandDetailFactory::new();
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
