<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    protected $table = 'category_details';

    protected $fillable = [
        'category_id', 'locale', 'name', 'description'
    ];

    /**
     * Belongs to the Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Returns the parent category model if available (not a relation).
     */
    public function getParentCategoryAttribute()
    {
        return $this->category ? $this->category->parent : null;
    }

    /**
     * Optional: If categories are linked to brands, access the brand.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Polymorphic relation for attaching images or files to category details.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
