<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $table = 'categories';

    protected $fillable = [
        'slug', 'is_active', 'cover_img'
    ];

    public function details()
    {
        return $this->hasMany(CategoryDetail::class);
    }

    public function detail()
    {
        return $this->hasOne(CategoryDetail::class)->where('locale', app()->getLocale());
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

    public function getCoverImgUrlAttribute()
    {
        return $this->cover_img ? Storage::url($this->cover_img) : null;
    }
}
