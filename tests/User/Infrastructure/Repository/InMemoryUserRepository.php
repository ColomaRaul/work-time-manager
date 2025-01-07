<?php declare(strict_types=1);

namespace App\Tests\User\Infrastructure\Repository;

use App\Tests\User\Domain\UserMother;
use App\User\Domain\Finder\UserCriteria;
use App\User\Domain\User;
use App\User\Domain\UserRepositoryInterface;

final class InMemoryUserRepository implements UserRepositoryInterface
{
    private array $usersById = [];
    private array $usersByEmail = [];

    public function byId(string $id): ?User
    {
        return array_key_exists($id, $this->usersById) ? $this->usersById[$id] : null;
    }

    public function byEmail(string $email): ?User
    {
        return array_key_exists($email, $this->usersByEmail) ? $this->usersByEmail[$email] : null;
    }

    public function save(User $user): void
    {
        $this->usersById[$user->id()->value()] = $user;
        $this->usersByEmail[$user->email()->value()] = $user;
    }

    public function byCriteria(UserCriteria $criteria): array
    {
        return $this->usersById;
    }
}
