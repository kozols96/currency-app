<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\CurrencyRateRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: CurrencyRateRepository::class)]
#[ORM\Table(name: 'currency_rates')]
class CurrencyRate
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    #[Ignore]
    private int $id;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, unique: true)]
    private DateTimeImmutable $lastUpdate;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 4)]
    #[SerializedName('GBP')]
    private float $gbp;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 4)]
    #[SerializedName('USD')]
    private float $usd;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 4)]
    #[SerializedName('AUD')]
    private float $aud;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLastUpdate(): DateTimeImmutable
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(DateTimeImmutable $lastUpdate): static
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getGbp(): float
    {
        return $this->gbp;
    }

    public function setGbp(float $gbp): static
    {
        $this->gbp = $gbp;

        return $this;
    }

    public function getUsd(): float
    {
        return $this->usd;
    }

    public function setUsd(float $usd): static
    {
        $this->usd = $usd;

        return $this;
    }

    public function getAud(): float
    {
        return $this->aud;
    }

    public function setAud(float $aud): static
    {
        $this->aud = $aud;

        return $this;
    }
}
