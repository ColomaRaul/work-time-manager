<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Deleter;

use App\Shared\Domain\DomainActions;
use App\WorkEntry\Domain\Finder\UserWorkEntryFinder;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final class WorkEntryUserDeleter extends DomainActions
{
    public function __construct(
        private readonly WorkEntryRepositoryInterface $repository,
        private readonly UserWorkEntryFinder $finder,
    ) {
    }

    public function delete(string $userId): void
    {
        $workEntries = $this->finder->find($userId);

        /** @var WorkEntry $workEntry */
        foreach ($workEntries as $workEntry) {
            $workEntry->delete();
            $this->repository->save($workEntry);
            $this->publishedEvents = array_merge($this->publishedEvents, $workEntry->pullDomainEvents());
        }
    }
}
