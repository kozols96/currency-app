<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\CurrencyRate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CurrencyRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyRate::class);
    }

    public function save(CurrencyRate $currencyRate, bool $flush = false): void
    {
        if (!$this->findOneBy(['lastUpdate' => $currencyRate->getLastUpdate()])) {
            $this->getEntityManager()->persist($currencyRate);

            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }
    }
}
