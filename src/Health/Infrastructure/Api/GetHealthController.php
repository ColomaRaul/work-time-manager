<?php declare(strict_types=1);

namespace App\Health\Infrastructure\Api;

use App\Health\Application\GetHealth\GetHealthQuery;
use App\Shared\Infrastructure\Api\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

final class GetHealthController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(): JsonResponse
    {
        $response = $this->ask(new GetHealthQuery());

        return new JsonResponse($response->toArray());
    }
}
