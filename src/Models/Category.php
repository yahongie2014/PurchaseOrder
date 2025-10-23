<?php

namespace App\Models\PurchaseOrder;

use App\Models\PurchaseOrder\Concerns\Auditable;
use App\Models\PurchaseOrder\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use SoftDeletes, Auditable, HasFactory, HasTranslations;

    public $translatable = ['translation'];

    protected $fillable = ['parent_id', 'slug', 'name', 'translation', 'position', 'is_active'];
    protected $casts = [
        'is_active' => 'bool',
        'meta_translations' => 'array'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product')->withTimestamps();
    }

    protected static function newFactory()
    {
        return \Database\Factories\CategoryFactory::new();
    }
}
