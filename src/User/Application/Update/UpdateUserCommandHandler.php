<?php declare(strict_types=1);

namespace App\User\Application\Update;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\User\Domain\Updater\UserUpdater;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class UpdateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserUpdater $updater,
    ) {
    }

    public function __invoke(UpdateUserCommand $command): void
    {
        $this->updater->update(
            $command->id(),
            $command->name(),
            $command->email(),
            $command->password()
        );
    }
}
