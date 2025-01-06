<?php declare(strict_types=1);

namespace App\Shared\Domain\Event;

use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\ORM\EntityManagerInterface;

final readonly class EventStore
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function store(
        string $aggregateId,
        string $eventName,
        array $payload,
        string $occurredOn,
    ): void {
        $this->entityManager->getConnection()->insert('event_store', [
            'id' => Uuid::random()->value(),
            'aggregate_id' => $aggregateId,
            'event_name' => $eventName,
            'payload' => json_encode($payload),
            'occurred_on' => $occurredOn,
            'created_at' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
        ]);
    }
}
