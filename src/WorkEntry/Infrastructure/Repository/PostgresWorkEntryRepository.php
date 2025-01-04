<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Repository;

use App\Shared\Domain\Criteria\CriteriaInterface;
use App\Shared\Infrastructure\Repository\DoctrineRepository;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final class PostgresWorkEntryRepository extends DoctrineRepository implements WorkEntryRepositoryInterface
{
    public function byId(string $id): ?WorkEntry
    {
        return $this->repository(WorkEntry::class)->find($id);
    }

    public function save(WorkEntry $workEntry): void
    {
        try {
            $this->persist($workEntry);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('dead here');
            throw new \Exception($e->getMessage());
        }
    }

    public function byCriteria(CriteriaInterface $criteria): array
    {
        return $this->repository(WorkEntry::class)
            ->matching($criteria->convertToCriteriaDatabase())->toArray();
    }
}
