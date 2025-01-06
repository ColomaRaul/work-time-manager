<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Update;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\Event\DomainEventPublisher;
use App\WorkEntry\Domain\Updater\WorkEntryUpdater;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

#[AsMessageHandler]
final readonly class UpdateWorkEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private WorkEntryUpdater $updater,
        private DomainEventPublisher $publisher
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(UpdateWorkEntryCommand $command): void
    {
        $this->updater->update(
            $command->id(),
            $command->userId(),
            $command->startDate(),
            $command->endDate()
        );

        $this->publisher->publish($this->updater->publishedEvents());
    }
}
