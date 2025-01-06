<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Finder;

use App\Shared\Domain\Criteria\CriteriaInterface;
use Doctrine\Common\Collections\Criteria;

final readonly class UserWorkEntryCriteria implements CriteriaInterface
{
    public function __construct(
        private string $userId,
        private ?int $limit = null,
        private ?int $offset = null,
    )
    {
    }

    public function userId(): string
    {
        return $this->userId;
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

        $criteria->andWhere(Criteria::expr()->eq('userId', $this->userId()));
        $criteria->andWhere(Criteria::expr()->isNull('deletedAt'));

        if ($this->limit() !== null) {
            $criteria->setMaxResults($this->limit());
        }

        if ($this->offset() !== null) {
            $criteria->setFirstResult($this->offset());
        }

        $criteria->orderBy(['workEntryTime.start' => 'desc']);

        return $criteria;
    }
}
