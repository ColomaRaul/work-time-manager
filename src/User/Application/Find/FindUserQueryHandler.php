<?php declare(strict_types=1);

namespace App\User\Application\Find;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\User\Domain\Finder\UserFinder;
use App\User\Domain\Finder\UserCriteria;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class FindUserQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private UserFinder $finder
    )
    {
    }

    public function __invoke(FindUserQuery $query): FindUserQueryResponse
    {
        return new FindUserQueryResponse($this->finder->find(
            $query->name(),
            $query->email(),
            $query->orderBy(),
            $query->order(),
            $query->limit(),
            $query->offset()
        ));
    }
}
