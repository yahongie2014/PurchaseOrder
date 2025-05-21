<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CurrencyRate
 *
 * @property int $id
 * @property string $currency_code
 * @property float $rate
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $products
 */
class CurrencyRate extends Model
{
    protected $table = 'currency_rates';

    protected $fillable = ['currency_code', 'rate'];

    protected $casts = [
        'rate' => 'float',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'currency_code', 'currency_code');
    }
}
