<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use HasTranslations, HasFactory;

    protected $table = 'brands';

    protected $fillable = ['slug', 'logo', 'name', 'translation', 'is_active'];

    protected $casts = [
        'translation' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\BrandFactory::new();
    }

    public function getNameAttribute()
    {
        return $this->getName(app()->getLocale());
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


    public function details()
    {
        return $this->hasMany(BrandDetail::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
