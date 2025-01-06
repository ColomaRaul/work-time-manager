<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Deleter;

use App\Shared\Domain\DomainActions;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final class WorkEntryDeleter extends DomainActions
{
    public function __construct(
        private readonly WorkEntryRepositoryInterface $repository,
    )
    {
    }

    public function delete(string $id): void
    {
        $workEntry = $this->repository->byId($id);
        $workEntry->delete();

        $this->repository->save($workEntry);
        $this->publishedEvents = $workEntry->pullDomainEvents();
    }
}
