<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Delete;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\WorkEntry\Domain\Deleter\WorkEntryDeleter;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class DeleteWorkEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private WorkEntryDeleter $deleter,
    )
    {
    }

    public function __invoke(DeleteWorkEntryCommand $command): void
    {
        $this->deleter->delete($command->id());
    }
}
