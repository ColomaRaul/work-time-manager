<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Finder;

use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final readonly class UserWorkEntryFinder
{
    public function __construct(private WorkEntryRepositoryInterface $repository)
    {
    }

    public function find(
        string $userId,
        ?int $limit = null,
        ?int $offset = null
    ): array
    {
        return $this->repository->byCriteria(
            new UserWorkEntryCriteria(
                $userId,
                $limit,
                $offset
            )
        );
    }
}
