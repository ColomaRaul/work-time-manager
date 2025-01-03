<?php declare(strict_types=1);

namespace App\Shared\Infrastructure\Security;

use App\Shared\Domain\PasswordHasherInterface;
use App\User\Domain\User;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface as SymfonyPasswordHasherInterface;

final readonly class PasswordHasher implements PasswordHasherInterface
{
    private SymfonyPasswordHasherInterface $hasher;

    public function __construct(
        PasswordHasherFactoryInterface $hasherFactory,
    ) {
        $this->hasher = $hasherFactory->getPasswordHasher(User::class);
    }

    public function hash(string $password): string
    {
        return $this->hasher->hash($password);
    }

    public function check(string $password, string $passwordHash): bool
    {
        return $this->hasher->verify($passwordHash, $password);
    }
}
