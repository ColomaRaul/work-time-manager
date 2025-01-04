<?php declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

final class DateTime
{
    public function __construct(protected string $value)
    {
    }

    public static function from(string $value): self
    {
        return new self($value);
    }

}
