<?php declare(strict_types=1);

namespace App\User\Infrastructure\Api\Update;

use App\Shared\Infrastructure\Api\ApiController;
use App\User\Application\Update\UpdateUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class UpdateUserController extends ApiController
{
    public function __invoke(
        string $id,
        #[MapRequestPayload] UpdateUserRequest $request,
    ): JsonResponse
    {
        $this->dispatch(
            new UpdateUserCommand(
                $id,
                $request->name,
                $request->email,
                $request->password,
            )
        );

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
