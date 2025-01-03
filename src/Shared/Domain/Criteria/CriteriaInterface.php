<?php declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

use Doctrine\Common\Collections\Criteria;

interface CriteriaInterface
{
    public function convertToCriteriaDatabase(): Criteria;
}
