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
        'translation' => 'array'
    ];

    protected static function newFactory()
    {
        return \Database\Factories\CategoryFactory::new();
    }

    public function getName($locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        $translation = $this->translation;
        if (is_string($translation)) {
            $decoded = json_decode($translation, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $translation = $decoded;
            }
        }

        if (is_array($translation)) {
            $allValuesAreScalars = true;
            foreach ($translation as $k => $v) {
                if (!is_scalar($v) && $v !== null) {
                    $allValuesAreScalars = false;
                    break;
                }
            }
            if ($allValuesAreScalars) {
                return $translation[$locale] ?? null;
            }

            if (isset($translation[$locale])) {
                if (is_array($translation[$locale])) {
                    return $translation[$locale]['name'] ?? null;
                }
            }
            $map = [];
            foreach ($translation as $item) {
                if (!is_array($item)) {
                    continue;
                }
                if (isset($item['fields']['locale'])) {
                    $loc = $item['fields']['locale'];
                    $map[$loc] = $item['fields']['name'] ?? null;
                    continue;
                }
                if (isset($item['locale'])) {
                    $loc = $item['locale'];
                    $map[$loc] = $item['name'] ?? null;
                }
            }

            return $map[$locale] ?? null;
        }

        return null;
    }

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
}
