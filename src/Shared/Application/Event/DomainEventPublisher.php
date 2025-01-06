<?php declare(strict_types=1);

namespace App\Shared\Application\Event;

use App\Shared\Domain\Event\DomainEvent;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final readonly class DomainEventPublisher
{
    public function __construct(private MessageBusInterface $eventBus)
    {
    }

    /**
     * @param DomainEvent[] $events
     * @throws Throwable
     */
    public function publish(array $events): void
    {
        try {
            foreach ($events as $event) {
                $this->eventBus->dispatch($event);
            }
        } catch (Throwable $e) {
            while ($e instanceof HandlerFailedException) {
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }
}
