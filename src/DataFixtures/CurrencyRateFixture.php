<?php

namespace App\DataFixtures;

use App\Entity\Factory\CurrencyRateTestFactory;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CurrencyRateFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist(CurrencyRateTestFactory::create(
            [
                'lastUpdate' => new DateTimeImmutable('2023-06-18'),
                'GBP' => 0.8546,
                'USD' => 1.0809,
                'AUD' => 1.5915
            ]
        ));

        $manager->flush();
    }
}
