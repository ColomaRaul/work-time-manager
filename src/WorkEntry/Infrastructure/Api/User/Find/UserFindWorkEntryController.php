<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Api\User\Find;

use App\Shared\Infrastructure\Api\ApiController;
use App\WorkEntry\Application\User\Find\UserFindWorkEntryQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class UserFindWorkEntryController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = $this->getAuthenticatedUser();

        if (null === $user) {
            return new JsonResponse(status: Response::HTTP_UNAUTHORIZED);
        }

        $response = $this->ask(
            new UserFindWorkEntryQuery(
                $user->id,
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
