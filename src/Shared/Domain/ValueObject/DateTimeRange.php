<?php declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use DateTimeInterface;

abstract class DateTimeRange
{
    public function __construct(
        protected readonly DateTimeInterface $start,
        protected readonly ?DateTimeInterface $end = null
    ) {
    }

    public function start(): DateTimeInterface
    {
        return $this->start;
    }

    public function end(): ?DateTimeInterface
    {
        return $this->end;
    }
}
