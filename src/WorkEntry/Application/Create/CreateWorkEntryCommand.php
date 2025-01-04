<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Create;

use App\Shared\Application\Command\CommandInterface;

final class CreateWorkEntryCommand implements CommandInterface
{
    public function __construct(
        public string $userId
    )
    {
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
