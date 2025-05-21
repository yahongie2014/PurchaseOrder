<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    protected $table = 'category_details';
    protected $fillable = [
        'category_id', 'locale', 'name', 'description'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}