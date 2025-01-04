<?php declare(strict_types=1);

namespace App\WorkEntry\Domain;

use App\Shared\Domain\ValueObject\DateTimeRange;
use DateTimeImmutable;

final class WorkEntryTime extends DateTimeRange
{
    public static function initialize(): self
    {
        return new self(new DateTimeImmutable());
    }

    public function isWorking(): bool
    {
        return $this->end() === null;
    }

    public function updateStart(DateTimeImmutable $start): self
    {
        return new self($start, $this->end());
    }

    public function updateEnd(DateTimeImmutable $end): self
    {
        return new self($this->start(), $end);
    }
}
