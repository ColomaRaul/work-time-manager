<?php declare(strict_types=1);

namespace App\User\Domain\Deleter;

use App\User\Domain\UserRepositoryInterface;

final class UserDeleter
{
    public function __construct(
        private UserRepositoryInterface $repository,
    ) {
    }

    public function delete(string $id): void
    {
        $user = $this->repository->byId($id);
        $user->delete();

        $this->repository->save($user);
        //Launch all events
    }
}
