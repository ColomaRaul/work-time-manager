<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Starter;

use App\Shared\Domain\ValueObject\Uuid;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final readonly class WorkEntryStarter
{
    public function __construct(
        private WorkEntryRepositoryInterface $repository,
    )
    {
    }

    public function start(Uuid $workEntryId, Uuid $userId): void
    {
        try {
            $workEntries = $this->repository->byCriteria(new WorkEntryActivesCriteria($userId));
        } catch (\Exception $e) {
            throw new \Exception('Error getting work entries');
        }


        if (!empty($workEntries)) {
            //TODO create own exceptions
            throw new \Exception('User has an active work entry');
        }

        $workEntry = WorkEntry::start($workEntryId, $userId);

        $this->repository->save($workEntry);
        // TODO Publish all events
    }
}
