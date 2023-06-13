<?php declare(strict_types=1);

namespace App\Util\DTO\Factory;

use App\Util\DTO\CurrencyRateApiResponse;
use DateTimeImmutable;

class CurrencyRateApiResponseFactory
{
    public static function create(array $data, DateTimeImmutable $lastUpdate): CurrencyRateApiResponse
    {
        return (new CurrencyRateApiResponse())
            ->setLastUpdate($lastUpdate)
            ->setRates(RatesFactory::create($data['rates'] ?? []));
    }
}
