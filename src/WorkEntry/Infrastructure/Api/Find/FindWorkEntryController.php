<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Api\Find;

use App\Shared\Infrastructure\Api\ApiController;
use App\WorkEntry\Application\Find\FindWorkEntryQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

final class FindWorkEntryController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        $response = $this->ask(
            new FindWorkEntryQuery(
                $request->query->get('userId'),
                $request->query->get('orderBy', 'createdAt'),
                $request->query->get('order', 'desc'),
                $request->query->has('limit')
                    ? $request->query->getInt('limit')
                    : null,
                $request->query->has('offset')
                    ? $request->query->getInt('offset')
                    : null,
            )
        );

        return new JsonResponse($response->data());
    }
}
