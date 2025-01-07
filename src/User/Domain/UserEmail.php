<?php declare(strict_types=1);

namespace App\User\Domain;

use Stringable;

final class UserEmail implements Stringable
{
    public function __construct(protected string $value)
    {
        $this->isValidEmail($this->value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $otherEmail): bool
    {
        return $otherEmail->value() === $this->value;
    }

    public static function from(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private function isValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf('%s does not allow the value %s', self::class, $email));
        }
    }
}
