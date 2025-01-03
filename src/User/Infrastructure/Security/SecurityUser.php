<?php declare(strict_types=1);

namespace App\User\Infrastructure\Security;

use App\User\Domain\User;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class SecurityUser implements UserInterface, EquatableInterface, PasswordAuthenticatedUserInterface
{

    public string $id;
    public string $email;
    public string $name;
    public ?string $password;
    private array $roles;

    public function __construct(User $user)
    {
        $this->id = $user->id();
        $this->email = $user->email();
        $this->name = $user->name();
        $this->password = $user->password();
        $this->roles = [$user->role()];
    }

    public function isEqualTo(UserInterface $user): bool
    {
        return $user instanceof self && $this->id === $user->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials(): void
    {
        $this->password = null;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
