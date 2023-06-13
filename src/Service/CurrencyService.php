<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Factory\CurrencyRateFactory;
use App\Exception\CurrencyApiServiceUnavailableException;
use App\Repository\CurrencyRateRepository;
use App\Util\DTO\CurrencyRateApiResponse;
use App\Util\DTO\Factory\CurrencyRateApiResponseFactory;
use DateTimeImmutable;
use Doctrine\Common\Collections\Criteria;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class CurrencyService
{
    public function __construct(
        private CurrencyRateRepository $currencyRateRepository,
        private HttpClientInterface    $currencyApiClient,
        private CacheInterface         $cache
    ) {
    }

    /**
     * @return array
     * @throws InvalidArgumentException
     */
    public function getCurrencyRates(): array
    {
        $currentDate = new DateTimeImmutable('today');
        $key = sprintf('currency-rates-%s', $currentDate->format('Y-m-d'));

        return $this->cache->get($key, function (ItemInterface $item) use ($currentDate) {
            $item->expiresAfter(1800);

            if (!$this->currencyRateRepository->findOneBy(['lastUpdate' => $currentDate])) {
                $currencyRateApiResponse = $this->handleCurrencyApiRequest($currentDate);

                $this->currencyRateRepository->save(CurrencyRateFactory::create($currencyRateApiResponse), true);
            }

            return $this->currencyRateRepository->findBy([], ['lastUpdate' => Criteria::DESC]);
        });
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    private function handleCurrencyApiRequest(DateTimeImmutable $currentDate): CurrencyRateApiResponse
    {
        $currencyApiResponse = $this->currencyApiClient->request(Request::METHOD_GET, 'rates');

        if (Response::HTTP_OK !== $currencyApiResponse->getStatusCode()) {
            throw new CurrencyApiServiceUnavailableException();
        }

        $currencyApiResponseData = $currencyApiResponse->toArray();
        $currencyApiLastUpdate = (new DateTimeImmutable())->setTimestamp($currencyApiResponseData['lastUpdate']);

        if ($currencyApiLastUpdate !== $currentDate) {
            return CurrencyRateApiResponseFactory::create($currencyApiResponseData, $currencyApiLastUpdate);
        }

        return CurrencyRateApiResponseFactory::create($currencyApiResponseData, $currentDate);
    }
}
