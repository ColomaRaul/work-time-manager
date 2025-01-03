<?php declare(strict_types=1);

namespace App\User\Domain;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\PasswordHasherInterface;
use App\Shared\Domain\ValueObject\Uuid;
use DateTimeInterface;

final class User extends AggregateRoot implements \JsonSerializable
{
    public function __construct(
        private readonly Uuid $id,
        private string $email,
        private string $password,
        private string $name,
        private UserRole $role,
        private DateTimeInterface $createdAt,
        private DateTimeInterface $updatedAt,
        private ?DateTimeInterface $deletedAt = null,
    ) {

    }

    public static function createUser(
        string $email,
        string $password,
        string $name,
        PasswordHasherInterface $passwordHasher,
    ): self {
        $user = new self(
            Uuid::random(),
            $email,
            $passwordHasher->hash($password),
            $name,
            UserRole::USER,
            new \DateTimeImmutable(),
            new \DateTimeImmutable(),
        );

//        $user->saveDomainEvent();

        return $user;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function role(): UserRole
    {
        return $this->role;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name(),
            'email' => $this->email(),
            'role' => $this->role()->value,
        ];
    }
}
