<?php declare(strict_types=1);

namespace App\User\Infrastructure\Api\Create;

use App\Shared\Infrastructure\Api\ApiController;
use App\User\Application\Create\CreateUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Throwable;

final class CreateUserController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(
       #[MapRequestPayload] CreateUserRequest $request,
    ): JsonResponse {
        $this->dispatch(new CreateUserCommand(
            $request->name,
            $request->email,
            $request->password
        ));

        return new JsonResponse(status: Response::HTTP_CREATED);
    }
}
