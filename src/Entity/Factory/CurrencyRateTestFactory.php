<?php declare(strict_types=1);

namespace App\Entity\Factory;

use App\Entity\CurrencyRate;

class CurrencyRateTestFactory
{
    public static function create(array $data): CurrencyRate
    {
        return (new CurrencyRate())
            ->setLastUpdate($data['lastUpdate'])
            ->setGbp($data['GBP'])
            ->setUsd($data['USD'])
            ->setAud($data['AUD']);
    }
}
