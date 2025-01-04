<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Finder;

use App\Shared\Domain\Criteria\CriteriaInterface;
use Doctrine\Common\Collections\Criteria;

final readonly class WorkEntryCriteria implements CriteriaInterface
{
    public function __construct(
        private ?string $userId = null,
        private ?string $orderBy = 'createdAt',
        private ?string $order = 'desc',
        private ?int $limit = null,
        private ?int $offset = null,
    ) {
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

    public function convertToCriteriaDatabase(): Criteria
    {
        $criteria = Criteria::create();

        if ($this->userId() !== null) {
            $criteria->andWhere(Criteria::expr()->eq('userId', $this->userId()));
        }

        if ($this->orderBy() !== null && $this->order() !== null) {
            $criteria->orderBy([$this->orderBy() => $this->order()]);
        }

        if ($this->limit() !== null) {
            $criteria->setMaxResults($this->limit());
        }

        if ($this->offset() !== null) {
            $criteria->setFirstResult($this->offset());
        }

        return $criteria;
    }
}
