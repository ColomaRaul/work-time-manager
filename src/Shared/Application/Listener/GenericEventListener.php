<?php declare(strict_types=1);

namespace App\Shared\Application\Listener;

use App\Shared\Domain\Event\EventInterface;
use App\Shared\Domain\Event\EventStore;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GenericEventListener
{
    public function __construct(private EventStore $eventStore)
    {
    }

    public function __invoke(EventInterface $event): void
    {
        $this->eventStore->store(
            $event->aggregateId(),
            $event->eventName(),
            $event->payload(),
            $event->occurredOn()
        );
    }
}
