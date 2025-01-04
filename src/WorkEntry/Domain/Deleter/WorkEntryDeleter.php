<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Deleter;

use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final readonly class WorkEntryDeleter
{
    public function __construct(
        private WorkEntryRepositoryInterface $repository,
    )
    {
    }

    public function delete(string $id): void
    {
        $workEntry = $this->repository->byId($id);
        $workEntry->delete();

        $this->repository->save($workEntry);
        //Launch all events
    }
}
