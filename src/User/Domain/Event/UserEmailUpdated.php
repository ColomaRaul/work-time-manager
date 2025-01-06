<?php declare(strict_types=1);

namespace App\User\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\Event\EventInterface;

final class UserEmailUpdated extends DomainEvent implements EventInterface
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
        return 'user_email_updated';
    }
}
