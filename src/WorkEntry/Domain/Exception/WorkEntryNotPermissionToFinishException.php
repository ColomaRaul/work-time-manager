<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Exception;

use DomainException;

final class WorkEntryNotPermissionToFinishException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Work entry user has not permission to finish');
    }
}
