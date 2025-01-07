<?php declare(strict_types=1);

namespace App\Tests\WorkEntry\Domain;

use App\WorkEntry\Domain\WorkEntryTime;
use DateTimeImmutable;

final class WorkEntryTimeMother
{
    public static function create(
        ?DateTimeImmutable $start = null,
        ?DateTimeImmutable $end = null,
    ): WorkEntryTime
    {
        return new WorkEntryTime(
            $start ?? new DateTimeImmutable(),
            $end
        );
    }
}
