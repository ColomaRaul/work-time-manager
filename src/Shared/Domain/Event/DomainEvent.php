<?php declare(strict_types=1);

namespace App\Shared\Domain\Event;

abstract class DomainEvent
{
    public function __construct(
        private readonly string $aggregateId
    )
    {
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }
}
