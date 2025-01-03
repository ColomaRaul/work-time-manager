<?php declare(strict_types=1);

namespace App\User\Infrastructure\Orm;

use App\User\Domain\UserRole;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class UserRoleType extends StringType
{
    public function getName(): string
    {
        return self::class;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UserRole
    {
        return UserRole::from($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if ($value instanceof UserRole) {
            return $value->value;
        }

        return $value;
    }
}
