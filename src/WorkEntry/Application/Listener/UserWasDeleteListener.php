<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Listener;

use App\Shared\Application\Event\DomainEventPublisher;
use App\User\Domain\Event\UserDeleted;
use App\WorkEntry\Domain\Deleter\WorkEntryUserDeleter;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

#[AsMessageHandler]
final readonly class UserWasDeleteListener
{
    public function __construct(
        private WorkEntryUserDeleter $workEntryUserDeleter,
        private DomainEventPublisher $domainEventPublisher,
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(UserDeleted $event): void
    {
        $this->workEntryUserDeleter->delete($event->aggregateId());
        $this->domainEventPublisher->publish($this->workEntryUserDeleter->publishedEvents());
    }
}
