<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Creator;

use App\Shared\Domain\DomainActions;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final class WorkEntryCreator extends DomainActions
{
    public function __construct(
        private readonly WorkEntryRepositoryInterface $repository
    )
    {
    }

    public function create(string $userId): void
    {
        $workEntry = WorkEntry::createWorkEntry($userId);
        $this->repository->save($workEntry);

        $this->publishedEvents = $workEntry->pullDomainEvents();
    }
}
