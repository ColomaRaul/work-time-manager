<?php declare(strict_types=1);

namespace App\User\Application\Create;

use App\Shared\Application\Command\CommandInterface;

final class CreateUserCommand implements CommandInterface
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

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
