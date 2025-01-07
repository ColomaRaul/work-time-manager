<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Exception;

use DomainException;

final class WorkEntryIsFinishedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('The work entry is already finished');
    }
}
