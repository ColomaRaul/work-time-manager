<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Updater;

use App\Shared\Domain\DomainActions;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final class WorkEntryUpdater extends DomainActions
{
    public function __construct(
        private readonly WorkEntryRepositoryInterface $repository,
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
        $this->publishedEvents = $workEntry->pullDomainEvents();
    }
}
