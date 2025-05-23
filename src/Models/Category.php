<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations, HasFactory;


    protected $table = 'categories';

    protected $fillable = [
        'slug', 'is_active', 'translation', 'cover_img'
    ];
    protected $casts = [
        'translation' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\CategoryFactory::new();
    }

    public function getName($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        if (!is_array($this->translation)) {
            return null;
        }
        $translation = [];

        foreach ($this->translation as $item) {
            if (!isset($item['fields']['locale'])) {
                continue;
            }
            $loc = $item['fields']['locale'];
            $translation[$loc] = [
                'name' => $item['fields']['name'] ?? null,
                'description' => $item['fields']['description'] ?? null,
            ];
        }

        return $translation[$locale]['name'] ?? null;
    }

    public function getDescription($locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        if (!is_array($this->translation)) {
            return null;
        }
        $translation = [];

        foreach ($this->translation as $item) {
            if (!isset($item['fields']['locale'])) {
                continue;
            }
            $loc = $item['fields']['locale'];
            $translation[$loc] = [
                'name' => $item['fields']['name'] ?? null,
                'description' => $item['fields']['description'] ?? null,
            ];
        }

        return $translation[$locale]['description'] ?? null;
    }


    public function getNameAttribute()
    {
        return $this->getName(app()->getLocale());
    }

    public function getDescriptionAttribute()
    {
        return $this->getDescription(app()->getLocale());
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
