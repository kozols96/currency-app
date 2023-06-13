<?php declare(strict_types=1);

namespace App\Util\DTO;

use DateTimeImmutable;

class CurrencyRateApiResponse
{
    private DateTimeImmutable $lastUpdate;

    private Rates $rates;

    public function getLastUpdate(): DateTimeImmutable
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(DateTimeImmutable $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getRates(): Rates
    {
        return $this->rates;
    }

    public function setRates(Rates $rates): self
    {
        $this->rates = $rates;

        return $this;
    }
}
