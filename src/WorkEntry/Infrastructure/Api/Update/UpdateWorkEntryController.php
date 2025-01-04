<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Api\Update;

use App\Shared\Infrastructure\Api\ApiController;
use App\WorkEntry\Application\Update\UpdateWorkEntryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Throwable;

final class UpdateWorkEntryController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        string $id,
        #[MapRequestPayload] UpdateWorkEntryRequest $request,
    ): JsonResponse
    {
        $this->dispatch(
            new UpdateWorkEntryCommand(
                $id,
                $request->userId,
                $request->startDate,
                $request->endDate,
            )
        );

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
