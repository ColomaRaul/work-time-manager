<?php declare(strict_types=1);

namespace App\Shared\Application\Event;

use App\Shared\Domain\Event\DomainEvent;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class DomainEventPublisher
{
    public function __construct(private MessageBusInterface $eventBus)
    {
    }

    /**
     * @param DomainEvent[] $events
     * @throws ExceptionInterface
     */
    public function publish(array $events): void
    {
        foreach ($events as $event) {
            $this->eventBus->dispatch($event);
        }
    }
}
