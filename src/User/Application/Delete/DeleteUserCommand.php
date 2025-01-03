<?php declare(strict_types=1);

namespace App\User\Application\Delete;

use App\Shared\Application\Command\CommandInterface;

final class DeleteUserCommand implements CommandInterface
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
