<?php declare(strict_types=1);

namespace App\Controller;

use App\Exception\CurrencyApiServiceUnavailableException;
use App\Service\CurrencyService;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

#[Route('/api/v1', 'currency')]
class CurrencyController extends AbstractController
{
    public function __construct(private readonly CurrencyService $currencyService)
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    #[Route(path: '/currency', name: 'get_currency_rates', methods: [Request::METHOD_GET])]
    public function getCurrencyRates(): JsonResponse
    {
        try {
            return $this->json(
                data: ['data' => $this->currencyService->getCurrencyRates()],
                context: [DateTimeNormalizer::FORMAT_KEY => 'd.m.Y']
            );
        } catch (CurrencyApiServiceUnavailableException $e) {
            throw new ServiceUnavailableHttpException(previous: $e);
        }
    }
}
