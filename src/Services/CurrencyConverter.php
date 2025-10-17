<?php

namespace PurchaseOrder\Services;

use Illuminate\Support\Facades\Config;
use InvalidArgumentException;

class CurrencyConverter
{
    protected array $rates;
    protected string $defaultCurrency;

    public function __construct()
    {
        $this->rates = Config::get('purchaseorder.currency_rates', []);
        $this->defaultCurrency = Config::get('purchaseorder.default_currency', 'USD');
    }

    /**
     * Convert an amount from the default currency to target currency.
     *
     * @param float $amount
     * @param string $targetCurrency
     * @return float
     */
    public function convert(float $amount, string $targetCurrency): float
    {
        $targetCurrency = strtoupper($targetCurrency);

        if (!isset($this->rates[$targetCurrency])) {
            throw new InvalidArgumentException("Unsupported currency: $targetCurrency");
        }

        $rate = $this->rates[$targetCurrency];

        return round($amount * $rate, 2);
    }

    /**
     * Get default currency code.
     */
    public function getDefaultCurrency(): string
    {
        return $this->defaultCurrency;
    }
}
