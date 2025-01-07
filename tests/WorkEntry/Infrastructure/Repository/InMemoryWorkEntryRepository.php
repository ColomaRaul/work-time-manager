<?php declare(strict_types=1);

namespace App\Tests\WorkEntry\Infrastructure\Repository;

use App\Shared\Domain\Criteria\CriteriaInterface;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final class InMemoryWorkEntryRepository implements WorkEntryRepositoryInterface
{
    private array $workEntries = [];

    public function byId(string $id): ?WorkEntry
    {
        return array_key_exists($id, $this->workEntries) ? $this->workEntries[$id] : null;
    }

    public function save(WorkEntry $workEntry): void
    {
        $this->workEntries[$workEntry->id()->value()] = $workEntry;
    }

    public function byCriteria(CriteriaInterface $criteria): array
    {
        return $this->workEntries;
    }
}
