<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Finder;

use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final readonly class WorkEntryFinder
{
    public function __construct(private WorkEntryRepositoryInterface $repository)
    {
    }

    public function find(
        ?string $userId,
        ?string $orderBy,
        ?string $order,
        ?int $limit,
        ?int $offset
    ): array {
        return $this->repository->byCriteria(
            new WorkEntryCriteria(
                $userId,
                $orderBy,
                $order,
                $limit,
                $offset
            )
        );
    }
}
