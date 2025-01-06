<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\Event\EventInterface;

final class WorkEntryDeleted extends DomainEvent implements EventInterface
{
    public function __construct(
        string $aggregateId,
        string $occurredOn,
        array $payload = [],
    ) {
        parent::__construct($aggregateId, $occurredOn, $payload);
    }

    public static function from(
        string $aggregateId,
        string $occurredOn,
        array $payload = []
    ): self {
        return new self($aggregateId, $occurredOn, $payload);
    }

    public function eventName(): string
    {
        return 'work_entry_deleted';
    }
}
