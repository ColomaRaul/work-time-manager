<?php declare(strict_types=1);

namespace App\Tests\WorkEntry\Domain;

use App\Shared\Domain\ValueObject\Uuid;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryTime;
use DateTimeImmutable;

final class WorkEntryMother
{
    public static function create(
        ?Uuid              $id = null,
        ?Uuid              $userId = null,
        ?WorkEntryTime     $workEntryTime = null,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $deletedAt = null,
    ): WorkEntry
    {
        return new WorkEntry($id ?? Uuid::random(),
            $userId ?? Uuid::random(),
            $workEntryTime ?? new WorkEntryTime(new DateTimeImmutable()),
            $createdAt ?? new DateTimeImmutable(),
            $updatedAt ?? new DateTimeImmutable(),
            $deletedAt
        );
    }
}
