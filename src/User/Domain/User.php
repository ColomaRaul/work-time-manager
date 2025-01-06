<?php declare(strict_types=1);

namespace App\User\Domain;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\PasswordHasherInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Event\UserCreated;
use DateTimeImmutable;
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
        $id = Uuid::random();
        $user = new self(
            $id,
            $email,
            $passwordHasher->hash($password),
            $name,
            UserRole::USER,
            new DateTimeImmutable(),
            new DateTimeImmutable(),
        );

        $user->saveDomainEvent(UserCreated::from(
            $id->value(),
            (new DateTimeImmutable())->format('Y-m-d H:i:s'),
            [
                'aggregateId' => $id->value(),
                'email' => $email,
                'name' => $name,
            ]
        ));

        return $user;
    }

    public function updateName(string $name): void
    {
        if ($this->name === $name) {
            return;
        }

        $this->name = $name;
        $this->updatedAt = new DateTimeImmutable();

        // save domain event // UserNameChanged
    }

    public function updateEmail(string $email): void
    {
        if ($this->email === $email) {
            return;
        }

        $this->email = $email;
        $this->updatedAt = new DateTimeImmutable();

        // save domain event // UserEmailChanged
    }

    public function updatePassword(string $password, PasswordHasherInterface $passwordHasher): void
    {
        if ($passwordHasher->check($password, $this->password)) {
            return;
        }

        $this->password = $passwordHasher->hash($password);
        $this->updatedAt = new DateTimeImmutable();

        // save domain event // UserPasswordChanged
    }

    public function delete(): void
    {
        if (null !== $this->deletedAt()) {
            return;
        }

        $this->deletedAt = new DateTimeImmutable();
        // save domain event // UserDeleted
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
            'active' => null === $this->deletedAt(),
        ];
    }
}
