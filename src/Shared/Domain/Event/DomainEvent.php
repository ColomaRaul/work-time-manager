<?php declare(strict_types=1);

namespace App\Shared\Domain\Event;

abstract class DomainEvent
{
    public function __construct(
        public readonly string $aggregateId,
        public readonly string $occurredOn,
        public readonly array $payload = [],
    ) {
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function payload(): array
    {
        return $this->payload;
    }

    public function occurredOn(): string
    {
        return $this->occurredOn;
    }

    abstract public function eventName(): string;
}
