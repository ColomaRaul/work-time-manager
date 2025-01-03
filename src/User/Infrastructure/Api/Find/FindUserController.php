<?php declare(strict_types=1);

namespace App\User\Infrastructure\Api\Find;

use App\Shared\Infrastructure\Api\ApiController;
use App\User\Application\Find\FindUserQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

final class FindUserController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        $response = $this->ask(
            new FindUserQuery(
                $request->query->get('name'),
                $request->query->get('email'),
                $request->query->get('orderBy', 'createdAt'),
                $request->query->get('order', 'desc'),
                $request->query->has('limit')
                    ? $request->query->getInt('limit')
                    : null,
                $request->query->has('offset')
                    ? $request->query->getInt('offset')
                    : null,
            ),
        );

        return new JsonResponse($response->data());
    }
}
