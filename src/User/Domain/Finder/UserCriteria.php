<?php declare(strict_types=1);

namespace App\User\Domain\Finder;

use App\Shared\Domain\Criteria\CriteriaInterface;
use Doctrine\Common\Collections\Criteria;

final class UserCriteria implements CriteriaInterface
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

    public function convertToCriteriaDatabase(): Criteria
    {
        $criteria = Criteria::create();

        if ($this->name() !== null) {
            $criteria->andWhere(Criteria::expr()->contains('name', $this->name()));
        }

        if ($this->email() !== null) {
            $criteria->andWhere(Criteria::expr()->contains('email', $this->email()));
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
