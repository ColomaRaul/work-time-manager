<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Find;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\WorkEntry\Domain\Finder\WorkEntryFinder;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class FindWorkEntryQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private WorkEntryFinder $finder
    )
    {
    }

    public function __invoke(FindWorkEntryQuery $query): FindWorkEntryQueryResponse
    {
        return new FindWorkEntryQueryResponse($this->finder->find(
            $query->userId(),
            $query->orderBy(),
            $query->order(),
            $query->limit(),
            $query->offset()
        ));
    }
}
