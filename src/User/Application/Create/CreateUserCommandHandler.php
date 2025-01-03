<?php declare(strict_types=1);

namespace App\User\Application\Create;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\User\Domain\Creator\UserCreator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserCreator $creator,
    )
    {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $this->creator->create(
            $command->name(),
            $command->email(),
            $command->password()
        );
    }
}
