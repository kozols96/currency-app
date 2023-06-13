<?php declare(strict_types=1);

namespace App\Util\DTO;

class Rates
{
    private float $GBP;

    private float $USD;

    private float $AUD;

    public function getGBP(): float
    {
        return $this->GBP;
    }

    public function setGBP(float $GBP): self
    {
        $this->GBP = $GBP;

        return $this;
    }

    public function getUSD(): float
    {
        return $this->USD;
    }

    public function setUSD(float $USD): self
    {
        $this->USD = $USD;

        return $this;
    }

    public function getAUD(): float
    {
        return $this->AUD;
    }

    public function setAUD(float $AUD): self
    {
        $this->AUD = $AUD;

        return $this;
    }
}
