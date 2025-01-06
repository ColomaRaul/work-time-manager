<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Create;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\Event\DomainEventPublisher;
use App\WorkEntry\Domain\Creator\WorkEntryCreator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

#[AsMessageHandler]
final readonly class CreateWorkEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private WorkEntryCreator $creator,
        private DomainEventPublisher $publisher
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(CreateWorkEntryCommand $command): void
    {
        $this->creator->create($command->userId());
        $this->publisher->publish($this->creator->publishedEvents());
    }
}
