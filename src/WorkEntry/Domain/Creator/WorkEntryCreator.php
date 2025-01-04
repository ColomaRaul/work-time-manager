<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Creator;

use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final class WorkEntryCreator
{
    public function __construct(
        private WorkEntryRepositoryInterface $repository
    )
    {
    }

    public function create(string $userId): void
    {
        $this->repository->save(
            WorkEntry::createWorkEntry(
                $userId
            )
        );
    }
}
