<?php declare(strict_types=1);

namespace App\Tests\User\Domain;

use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\User;
use App\User\Domain\UserEmail;
use App\User\Domain\UserRole;
use DateTimeImmutable;

final class UserMother
{
    public static function create(
        ?Uuid $id = null,
        ?UserEmail $email = null,
        ?string $password = null,
        ?string $user = null,
        ?UserRole $role = null,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $deletedAt = null,
    ): User
    {
        return new User(
            $id ?? Uuid::random(),
            $email ?? UserEmail::from('test@test.com'),
            $password ?? 'password',
            $user ?? 'user',
            $role ?? UserRole::ADMIN,
            $createdAt ?? new DateTimeImmutable(),
            $updatedAt ?? new DateTimeImmutable(),
            $deletedAt
        );
    }
}
