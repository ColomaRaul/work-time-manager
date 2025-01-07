<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Exception;

use DomainException;

final class WorkEntryNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Work entry not found');
    }
}
