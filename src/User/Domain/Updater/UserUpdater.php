<?php declare(strict_types=1);

namespace App\User\Domain\Updater;

use App\Shared\Domain\DomainActions;
use App\Shared\Domain\PasswordHasherInterface;
use App\User\Domain\UserRepositoryInterface;

final class UserUpdater extends DomainActions
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly PasswordHasherInterface $passwordHasher
    ) {
    }

    public function update(
        string $id,
        string $name,
        string $email,
        string $password
    ): void {
        $user = $this->repository->byId($id);

        $user->updateName($name);
        $user->updateEmail($email);
        $user->updatePassword($password, $this->passwordHasher);

        $this->repository->save($user);
        $this->publishedEvents = $user->pullDomainEvents();
    }
}
