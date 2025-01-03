<?php declare(strict_types=1);

namespace App\User\Application\Find;

use App\Shared\Application\Query\QueryInterface;

final class FindUserQuery implements QueryInterface
{
    public function __construct(
        private ?string $name = null,
        private ?string $email = null,
        private ?string $orderBy = 'createdAt',
        private ?string $order = 'desc',
        private ?int $limit = null,
        private ?int $offset = null,
    ) {
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function email(): ?string
    {
        return $this->email;
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
