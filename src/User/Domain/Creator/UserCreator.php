<?php declare(strict_types=1);

namespace App\User\Domain\Creator;

use App\Shared\Domain\PasswordHasherInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\User;
use App\User\Domain\UserRepositoryInterface;

final readonly class UserCreator
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private PasswordHasherInterface $passwordHasher
    )
    {
    }

    public function create(
        string $name,
        string $email,
        string $password,
    ): void {
        $this->repository->save(
            User::createUser(
                $email,
                $password,
                $name,
                $this->passwordHasher
            )
        );
    }
}
