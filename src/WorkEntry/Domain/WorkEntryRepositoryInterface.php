<?php declare(strict_types=1);

namespace App\WorkEntry\Domain;

use App\Shared\Domain\Criteria\CriteriaInterface;

interface WorkEntryRepositoryInterface
{
    public function byId(string $id): ?WorkEntry;

    public function save(WorkEntry $workEntry): void;

    public function byCriteria(CriteriaInterface $criteria): array;
}
