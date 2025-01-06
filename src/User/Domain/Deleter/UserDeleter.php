<?php declare(strict_types=1);

namespace App\User\Domain\Deleter;

use App\Shared\Domain\DomainActions;
use App\User\Domain\UserRepositoryInterface;

final class UserDeleter extends DomainActions
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function delete(string $id): void
    {
        $user = $this->repository->byId($id);
        $user->delete();

        $this->repository->save($user);
        $this->publishedEvents = $user->pullDomainEvents();
    }
}
