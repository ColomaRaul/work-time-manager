<?php declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm;

use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class UuidType extends StringType
{
    public function getName(): string
    {
        return self::class;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Uuid
    {
        return Uuid::from($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if ($value instanceof Uuid) {
            return $value->value();
        }

        return $value;
    }
}
