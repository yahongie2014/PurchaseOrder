<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use PurchaseOrder\Events\ProductUpdated;
use PurchaseOrder\Services\CurrencyConverter;

class Product extends Model
{
    protected $table = 'products';

    protected $dispatchesEvents = [
        'updated' => ProductUpdated::class,
    ];

    protected $fillable = [
        'sku', 'barcode', 'original_price', 'cost_price', 'sale_price', 'is_sale',
        'stock_quantity', 'tax_rate', 'is_taxable', 'unit',
        'weight', 'length', 'width', 'height',
        'brand_id', 'cover_img', 'tags', 'category_id',
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

    /**
     * Get translated unit name safely.
     *
     * Returns the translation if exists, otherwise returns the raw unit string.
     */
    public function getUnitTranslatedAttribute(): string
    {
        if (!$this->unit) {
            return '';
        }

        $key = 'purchase-order::units.' . $this->unit;
        $translation = __($key);

        return $translation === $key ? $this->unit : $translation;
    }

    /**
     * Get full URL of the cover image using Storage facade.
     */
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

    /**
     * Example accessor: get sale price converted to given currency.
     */
    public function getSalePriceInCurrency(string $currency): ?float
    {
        return $this->getConvertedPrice($this->sale_price, $currency);
    }

    public function currencyRate(): BelongsTo
    {
        return $this->belongsTo(CurrencyRate::class, 'currency_code', 'currency_code');
    }


}
