<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Api\Delete;

use App\Shared\Infrastructure\Api\ApiController;
use App\WorkEntry\Application\Delete\DeleteWorkEntryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class DeleteWorkEntryController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(string $id): JsonResponse
    {
        $this->dispatch(new DeleteWorkEntryCommand($id));

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
