<?php declare(strict_types=1);

namespace App\User\Application\Create;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\Event\DomainEventPublisher;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Creator\UserAdminCreator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Throwable;

#[AsMessageHandler]
final readonly class CreateUserAdminCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserAdminCreator $creator,
        private DomainEventPublisher $eventPublisher
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(CreateUserAdminCommand $command): void
    {
        $this->creator->create(
            Uuid::from($command->id()),
            $command->name(),
            $command->email(),
            $command->password()
        );

        $this->eventPublisher->publish($this->creator->publishedEvents());
    }
}
