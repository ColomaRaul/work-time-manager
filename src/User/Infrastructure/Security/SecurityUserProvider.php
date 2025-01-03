<?php declare(strict_types=1);

namespace App\User\Infrastructure\Security;

use App\User\Domain\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class SecurityUserProvider implements UserProviderInterface
{

    public function refreshUser(UserInterface $user): UserInterface
    {
        $user = new User('aa', 'aa@aa.com', 'ass', 'aaa', 'admin', new \DateTimeImmutable(), new \DateTimeImmutable());

        return new SecurityUser($user);
    }

    public function supportsClass(string $class): bool
    {
        return $class === SecurityUser::class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = new User('aa', 'aa@aa.com', 'ass', 'aaa', 'admin', new \DateTimeImmutable(), new \DateTimeImmutable());

        return new SecurityUser($user);
    }
}
