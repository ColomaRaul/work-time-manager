<?php declare(strict_types=1);

namespace App\WorkEntry\Application\User\End;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\WorkEntry\Domain\Finisher\WorkEntryFinisher;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class UserFinishWorkEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(private WorkEntryFinisher $workEntryFinisher)
    {
    }

    public function __invoke(UserFinishWorkEntryCommand $command): void
    {
        $this->workEntryFinisher->finish(Uuid::from($command->workEntryId()), Uuid::from($command->userId()));
    }
}
