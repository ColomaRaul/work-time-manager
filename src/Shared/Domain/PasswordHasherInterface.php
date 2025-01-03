<?php declare(strict_types=1);

namespace App\Shared\Domain;

interface PasswordHasherInterface
{
    public function hash(string $password): string;

    public function check(string $password, string $passwordHash): bool;
}
