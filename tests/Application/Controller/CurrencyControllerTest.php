<?php declare(strict_types=1);

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class CurrencyControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testGetCurrencyRates(): void
    {
        $this->client->request(Request::METHOD_GET, '/api/v1/currency');
        $response = $this->client->getResponse();

        self::assertResponseIsSuccessful();
        self::assertEquals(json_encode([
            'data' => [
                [
                    'lastUpdate' => date('d.m.Y', strtotime('2023-06-19')),
                    'GBP' => 0.8527,
                    'USD' => 1.0922,
                    'AUD' => 1.5964
                ],
                [
                    'lastUpdate' => date('d.m.Y', strtotime('2023-06-18')),
                    'GBP' => 0.8546,
                    'USD' => 1.0809,
                    'AUD' => 1.5915
                ]
            ]
        ]), $response->getContent());
    }
}
