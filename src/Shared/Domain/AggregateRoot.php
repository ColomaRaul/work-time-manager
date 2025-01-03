<?php declare(strict_types=1);

namespace App\Shared\Domain;

use App\Shared\Domain\Event\DomainEvent;

abstract class AggregateRoot
{
    /** @var array<DomainEvent> **/
    protected array $domainEvents = [];

    public function saveDomainEvent(DomainEvent $event): self
    {
        $this->domainEvents[] = $event;

        return $this;
    }

    /**
     * @return array<DomainEvent>
     */
    public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }
}
