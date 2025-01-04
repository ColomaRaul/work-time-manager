<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Api\Create;

use App\Shared\Infrastructure\Api\ApiController;
use App\WorkEntry\Application\Create\CreateWorkEntryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Throwable;

final class CreateWorkEntryController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        #[MapRequestPayload] CreateWorkEntryRequest $request,
    ): JsonResponse {
        $this->dispatch(new CreateWorkEntryCommand($request->userId));

        return new JsonResponse(status: Response::HTTP_CREATED);
    }
}
