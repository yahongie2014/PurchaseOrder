<?php
return [
    // existing config...

    'default_currency' => 'USD',

    // Supported currencies with conversion rates relative to USD
    'currency_rates' => [
        'USD' => 1,
        'EUR' => 0.91,
        'GBP' => 0.81,
        'EGP' => 30.9
    ],

    'redis' => [
        'channel_orders' => env('PURCHASEORDER_REDIS_CHANNEL_ORDERS', 'purchaseorder-orders'),
        'channel_products' => env('PURCHASEORDER_REDIS_CHANNEL_PRODUCTS', 'purchaseorder-products'),
    ],

];
