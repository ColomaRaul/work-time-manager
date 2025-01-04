<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Find;

use App\Shared\Application\Query\QueryInterface;

final class FindWorkEntryQuery implements QueryInterface
{
    public function __construct(
        private ?string $userId = null,
        private ?string $orderBy = 'createdAt',
        private ?string $order = 'desc',
        private ?int $limit = null,
        private ?int $offset = null,
    )
    {
    }

    public function userId(): ?string
    {
        return $this->userId;
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }

    public function order(): ?string
    {
        return $this->order;
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
