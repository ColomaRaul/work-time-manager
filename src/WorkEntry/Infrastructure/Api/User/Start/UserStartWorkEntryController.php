<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Api\User\Start;

use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Api\ApiController;
use App\WorkEntry\Application\User\Start\UserStartWorkEntryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class UserStartWorkEntryController extends ApiController
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

        $workEntryId = Uuid::random();
        $this->dispatch(
            new UserStartWorkEntryCommand(
                $workEntryId->value(),
                $user->id,
            ),
        );

        return new JsonResponse(['id' => $workEntryId->value()], Response::HTTP_CREATED);
    }
}
