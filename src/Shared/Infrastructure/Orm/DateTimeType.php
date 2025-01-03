<?php declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TimeImmutableType;

final class DateTimeType extends TimeImmutableType
{
    public function getName(): string
    {
        return self::class;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?\DateTimeImmutable
    {
        if (null === $value) {
            return null;
        }

        return \DateTimeImmutable::createFromFormat('Y-m-d H:i:sO', $value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value instanceof \DateTimeInterface) {
            return $value->format(\DateTimeInterface::ATOM);
        }

        return null;
    }
}
