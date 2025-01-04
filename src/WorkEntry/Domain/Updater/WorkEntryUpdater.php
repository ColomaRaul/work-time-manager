<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Updater;

use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final readonly class WorkEntryUpdater
{
    public function __construct(
        private WorkEntryRepositoryInterface $repository,
    )
    {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function update(
        string $id,
        string $userId,
        string $startDate,
        ?string $endDate,
    ): void
    {
        $workEntry = $this->repository->byId($id);

        $workEntry->updateUserId($userId);
        $workEntry->updateStartDate($startDate);
        $workEntry->updateEndDate($endDate);

        $this->repository->save($workEntry);
        //Publish all events
    }
}
