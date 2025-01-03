<?php declare(strict_types=1);

namespace App\User\Infrastructure\Api\Delete;

use App\Shared\Infrastructure\Api\ApiController;
use App\User\Application\Delete\DeleteUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class DeleteUserController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(string $id): JsonResponse
    {
        $this->dispatch(new DeleteUserCommand($id));

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
