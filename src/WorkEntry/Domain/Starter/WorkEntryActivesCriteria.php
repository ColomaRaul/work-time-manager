<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Starter;

use App\Shared\Domain\Criteria\CriteriaInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\Criteria;

final readonly class WorkEntryActivesCriteria implements CriteriaInterface
{
    public function __construct(
        private Uuid $userId,
    ) {
    }

    public function userId(): Uuid
    {
        return $this->userId;
    }

    public function convertToCriteriaDatabase(): Criteria
    {
          $criteria = Criteria::create();

          $criteria->andWhere(Criteria::expr()->eq('userId', $this->userId()->value()));
          $criteria->andWhere(Criteria::expr()->isNull('workEntryTime.end'));
          $criteria->andWhere(Criteria::expr()->isNull('deletedAt'));

          return $criteria;
    }
}
