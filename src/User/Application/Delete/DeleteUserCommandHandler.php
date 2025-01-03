<?php declare(strict_types=1);

namespace App\User\Application\Delete;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\User\Domain\Deleter\UserDeleter;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class DeleteUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserDeleter $deleter,
    )
    {
    }

    public function __invoke(DeleteUserCommand $command): void
    {
        $this->deleter->delete($command->id());
    }
}
