<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use PurchaseOrder\Events\ProductUpdated;
use PurchaseOrder\Services\CurrencyConverter;

class Product extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $table = 'products';

    protected $dispatchesEvents = [
        'updated' => ProductUpdated::class,
    ];

    protected $fillable = [
        'sku', 'barcode', 'original_price', 'cost_price', 'sale_price', 'is_sale',
        'stock_quantity', 'tax_rate', 'is_taxable', 'unit',
        'weight', 'length', 'width', 'height',
        'brand_id', 'cover_img', 'tags', 'category_id', 'currency_code',
        'synced_at', 'is_active', 'description'
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
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
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

    // تفاصيل المنتج متعددة اللغات
    public function details()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function detail()
    {
        return $this->hasOne(ProductDetail::class)->where('locale', app()->getLocale());
    }

    public function getNameAttribute()
    {
        return $this->detail?->name;
    }

    public function getDescriptionAttribute()
    {
        return $this->detail?->description;
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
