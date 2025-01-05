<?php declare(strict_types=1);

namespace App\User\Domain;

use App\User\Domain\Finder\UserCriteria;

interface UserRepositoryInterface
{
    public function byId(string $id): ?User;

    public function byEmail(string $email): ?User;

    public function save(User $user): void;

    public function byCriteria(UserCriteria $criteria): array;
}
