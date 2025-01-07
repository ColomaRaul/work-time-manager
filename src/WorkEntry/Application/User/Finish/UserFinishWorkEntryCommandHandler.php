<?php declare(strict_types=1);

namespace App\WorkEntry\Application\User\Finish;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\Event\DomainEventPublisher;
use App\Shared\Domain\ValueObject\Uuid;
use App\WorkEntry\Domain\Finisher\WorkEntryFinisher;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

#[AsMessageHandler]
final readonly class UserFinishWorkEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private WorkEntryFinisher $workEntryFinisher,
        private DomainEventPublisher $publisher,
    )
    {
    }

    public function __invoke(UserFinishWorkEntryCommand $command): void
    {
        $this->workEntryFinisher->finish(Uuid::from($command->workEntryId()), Uuid::from($command->userId()));
        $this->publisher->publish($this->workEntryFinisher->publishedEvents());
    }
}
