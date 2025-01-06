<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Delete;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\Event\DomainEventPublisher;
use App\WorkEntry\Domain\Deleter\WorkEntryDeleter;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

#[AsMessageHandler]
final readonly class DeleteWorkEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private WorkEntryDeleter $deleter,
        private DomainEventPublisher $publisher
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(DeleteWorkEntryCommand $command): void
    {
        $this->deleter->delete($command->id());
        $this->publisher->publish($this->deleter->publishedEvents());
    }
}
