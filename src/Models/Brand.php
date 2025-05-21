<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use HasTranslations, HasFactory;

    protected $table = 'brands';

    public $translatable = ['name', 'description'];

    protected $fillable = [
        'slug', 'logo', 'is_active'
    ];

    protected static function newFactory()
    {
        return \Database\Factories\BrandFactory::new();
    }

    public function details()
    {
        return $this->hasMany(BrandDetail::class);
    }

    public function detail()
    {
        return $this->hasOne(BrandDetail::class)->where('locale', app()->getLocale());
    }

    public function getNameAttribute()
    {
        return $this->detail?->name;
    }

    public function getDescriptionAttribute()
    {
        return $this->detail?->description;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
