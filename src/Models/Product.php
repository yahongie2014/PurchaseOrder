<?php

namespace App\Models\PurchaseOrder;

use App\Models\PurchaseOrder\Category;
use App\Models\PurchaseOrder\Concerns\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use PurchaseOrder\Events\ProductUpdated;
use PurchaseOrder\Services\CurrencyConverter;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Auditable, HasFactory, HasTranslations;

    protected $table = 'products';

    public $translatable = ['translation', 'description'];

    protected $dispatchesEvents = [
        'updated' => ProductUpdated::class,
    ];

    protected $fillable = [
        'sku',
        'barcode',
        'original_price',
        'cost_price',
        'sale_price',
        'is_sale',
        'stock_quantity',
        'tax_rate',
        'is_taxable',
        'unit',
        'weight',
        'length',
        'width',
        'height',
        'brand_id',
        'cover_img',
        'tags',
        'currency_code',
        'synced_at',
        'is_active',
        'description'
    ];

    protected $casts = [
        'tags' => 'array',
        'synced_at' => 'datetime',
        'cost_price' => 'float',
        'weight' => 'float',
        'length' => 'float',
        'width' => 'float',
        'height' => 'float',
        'is_sale' => 'boolean',
        'is_taxable' => 'boolean',
        'translation' => 'array',
        'description' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\ProductFactory::new();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product')
            ->withTimestamps();
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function details()
    {
        return $this->hasMany(ProductDetail::class);
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

    public function getUnitTranslatedAttribute(): string
    {
        if (!$this->unit) {
            return '';
        }

        $key = 'purchase-order::units.' . $this->unit;
        $translation = __($key);

        return $translation === $key ? $this->unit : $translation;
    }

    public function getCoverImgUrlAttribute(): ?string
    {
        return $this->cover_img ? Storage::url($this->cover_img) : null;
    }

    public function getConvertedPrice(float $price, string $currency): ?float
    {
        if ($price === null) {
            return null;
        }

        $converter = app(CurrencyConverter::class);

        return $converter->convert($price, $currency);
    }

    public function getSalePriceInCurrency(string $currency): ?float
    {
        return $this->getConvertedPrice($this->sale_price, $currency);
    }

    public function currencyRate(): BelongsTo
    {
        return $this->belongsTo(CurrencyRate::class, 'currency_code', 'currency_code');
    }
}
