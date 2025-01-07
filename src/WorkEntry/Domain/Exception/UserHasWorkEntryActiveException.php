<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Exception;

use DomainException;

final class UserHasWorkEntryActiveException extends DomainException
{
    public function __construct()
    {
        parent::__construct('User has an active work entry');
    }
}
