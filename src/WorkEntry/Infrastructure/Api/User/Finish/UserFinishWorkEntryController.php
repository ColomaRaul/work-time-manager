<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Api\User\Finish;

use App\Shared\Infrastructure\Api\ApiController;
use App\WorkEntry\Application\User\End\UserFinishWorkEntryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class UserFinishWorkEntryController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(string $id, Request $request): JsonResponse
    {
        $user = $this->getAuthenticatedUser();
        if (null === $user) {
            return new JsonResponse(status: Response::HTTP_UNAUTHORIZED);
        }

        $this->dispatch(
            new UserFinishWorkEntryCommand(
                $id,
                $user->id,
            ),
        );

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
