<?php declare(strict_types=1);

namespace App\User\Infrastructure\Security;

use App\User\Domain\User;
use App\User\Domain\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final readonly class SecurityUserProvider implements UserProviderInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    )
    {
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof SecurityUser) {
            throw new UnsupportedUserException(sprintf('Invalid user class %s', get_class($user)));
        }

        $email = $user->getUserIdentifier();
        $userEntity = $this->userRepository->byEmail($email);

        if (null === $userEntity) {
            throw new UserNotFoundException();
        }

        return new SecurityUser($userEntity);
    }

    public function supportsClass(string $class): bool
    {
        return $class === SecurityUser::class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $email = $identifier;
        $user = $this->userRepository->byEmail($email);
        if (null === $user) {
            throw new UserNotFoundException();
        }

        return new SecurityUser($user);
    }
}
