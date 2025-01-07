<?php declare(strict_types=1);

namespace App\User\Application\Create;

use App\Shared\Application\Command\CommandInterface;

final class CreateUserAdminCommand implements CommandInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string $password,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
