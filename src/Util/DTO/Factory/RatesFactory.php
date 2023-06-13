<?php declare(strict_types=1);

namespace App\Util\DTO\Factory;

use App\Util\DTO\Rates;

class RatesFactory
{
    public static function create(array $rates): Rates
    {
        return (new Rates())
            ->setGBP($rates['GBP'] ?? 0)
            ->setUSD($rates['USD'] ?? 0)
            ->setAUD($rates['AUD'] ?? 0);
    }
}
