<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Delete;

use App\Shared\Application\Command\CommandInterface;

final class DeleteWorkEntryCommand implements CommandInterface
{
    public function __construct(
        public string $id,
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
