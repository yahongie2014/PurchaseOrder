<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    use HasFactory;

    protected $table = 'currency_rates';

    protected $fillable = ['currency_code', 'rate'];

    protected $casts = [
        'rate' => 'float',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\CurrencyRateFactory::new();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'currency_code', 'currency_code');
    }
}
