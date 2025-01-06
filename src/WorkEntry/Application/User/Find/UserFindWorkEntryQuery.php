<?php declare(strict_types=1);

namespace App\WorkEntry\Application\User\Find;

use App\Shared\Application\Query\QueryInterface;

final class UserFindWorkEntryQuery implements QueryInterface
{
    public function __construct(
        public string $workerId,
        public ?int $limit,
        public ?int $offset
    ) {
    }

    public function workerId(): string
    {
        return $this->workerId;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }
}
