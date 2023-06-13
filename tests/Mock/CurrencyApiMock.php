<?php declare(strict_types=1);

namespace App\Tests\Mock;

use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpFoundation\Response;

class CurrencyApiMock extends MockHttpClient
{
    public function __construct()
    {
        parent::__construct(
            new MockResponse(
                file_get_contents('tests/Data/currency_rates.json'),
                ['http_code' => Response::HTTP_OK]
            )
        );
    }
}
