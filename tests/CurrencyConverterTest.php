<?php

use PHPUnit\Framework\TestCase;
use PurchaseOrder\Services\CurrencyConverter;

class CurrencyConverterTest extends TestCase
{
    public function test_convert_happy_path()
    {
        // instantiate without running constructor to avoid Laravel Facade/Config requirement
        $refClass = new ReflectionClass(CurrencyConverter::class);
        $converter = $refClass->newInstanceWithoutConstructor();

        // inject rates and default currency
        $this->setProtectedProperty($converter, 'rates', [
            'EUR' => 0.92,
            'JPY' => 150.25,
        ]);
        $this->setProtectedProperty($converter, 'defaultCurrency', 'USD');

        $result = $converter->convert(100.00, 'EUR');
        $this->assertEquals(92.00, $result);

        $result2 = $converter->convert(12.34, 'JPY');
        $this->assertEquals(round(12.34 * 150.25, 2), $result2);
    }

    public function test_convert_unsupported_currency_throws()
    {
        $this->expectException(InvalidArgumentException::class);

        $refClass = new ReflectionClass(CurrencyConverter::class);
        $converter = $refClass->newInstanceWithoutConstructor();
        $this->setProtectedProperty($converter, 'rates', ['EUR' => 0.9]);

        $converter->convert(10, 'ABC');
    }

    private function setProtectedProperty($object, string $property, $value)
    {
        $ref = new ReflectionClass($object);
        if ($ref->hasProperty($property)) {
            $prop = $ref->getProperty($property);
            $prop->setAccessible(true);
            $prop->setValue($object, $value);
            return;
        }

        // if property doesn't exist, add dynamically (not typical for this class)
        $object->{$property} = $value;
    }
}
