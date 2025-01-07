<?php declare(strict_types=1);

namespace App\User\Infrastructure\Orm;

use App\User\Domain\UserEmail;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class UserEmailType extends StringType
{
    public function getName(): string
    {
        return self::class;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UserEmail
    {
        return UserEmail::from($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if ($value instanceof UserEmail) {
            return $value->value();
        }

        return $value;
    }
}
