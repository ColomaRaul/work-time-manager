<?php declare(strict_types=1);

namespace App\User\Application\Delete;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\Event\DomainEventPublisher;
use App\User\Domain\Deleter\UserDeleter;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

#[AsMessageHandler]
final readonly class DeleteUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserDeleter $deleter,
        private DomainEventPublisher $eventPublisher,
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(DeleteUserCommand $command): void
    {
        $this->deleter->delete($command->id());
        $this->eventPublisher->publish($this->deleter->publishedEvents());
    }
}
