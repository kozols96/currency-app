<?php declare(strict_types=1);

namespace App\Entity\Factory;

use App\Entity\CurrencyRate;
use App\Util\DTO\CurrencyRateApiResponse;

class CurrencyRateFactory
{
    private const PRECISION = 4;

    public static function create(CurrencyRateApiResponse $currencyRateApiResponse): CurrencyRate
    {
        $rates = $currencyRateApiResponse->getRates();

        return (new CurrencyRate())
            ->setLastUpdate($currencyRateApiResponse->getLastUpdate())
            ->setGbp(round($rates->getGBP(), self::PRECISION))
            ->setUsd(round($rates->getUSD(), self::PRECISION))
            ->setAud(round($rates->getAUD(), self::PRECISION));
    }
}
