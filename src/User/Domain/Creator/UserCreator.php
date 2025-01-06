<?php declare(strict_types=1);

namespace App\User\Domain\Creator;

use App\Shared\Domain\DomainActions;
use App\Shared\Domain\PasswordHasherInterface;
use App\User\Domain\User;
use App\User\Domain\UserRepositoryInterface;

final class UserCreator extends DomainActions
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly PasswordHasherInterface $passwordHasher,
    ) {
    }

    public function create(
        string $name,
        string $email,
        string $password,
    ): void {
        $user = User::createUser(
            $email,
            $password,
            $name,
            $this->passwordHasher
        );

        $this->repository->save($user);
        $this->publishedEvents = $user->pullDomainEvents();
    }
}
