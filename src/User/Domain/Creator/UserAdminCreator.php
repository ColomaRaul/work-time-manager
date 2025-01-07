<?php declare(strict_types=1);

namespace App\User\Domain\Creator;

use App\Shared\Domain\DomainActions;
use App\Shared\Domain\PasswordHasherInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\User;
use App\User\Domain\UserRepositoryInterface;

final class UserAdminCreator extends DomainActions
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly PasswordHasherInterface $passwordHasher,
    ) {
    }

    public function create(
        Uuid $id,
        string $name,
        string $email,
        string $password,
    ): void
    {
        $user = User::createAdmin(
            $id,
            $email,
            $password,
            $name,
            $this->passwordHasher
        );

        $this->repository->save($user);
        $this->publishedEvents = $user->pullDomainEvents();
    }
}
