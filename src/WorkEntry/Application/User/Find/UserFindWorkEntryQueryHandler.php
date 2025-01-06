<?php declare(strict_types=1);

namespace App\WorkEntry\Application\User\Find;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\WorkEntry\Domain\Finder\UserWorkEntryFinder;
use App\WorkEntry\Domain\Finder\WorkEntryFinder;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class UserFindWorkEntryQueryHandler implements QueryHandlerInterface
{
    public function __construct(private UserWorkEntryFinder $finder)
    {
    }

    public function __invoke(UserFindWorkEntryQuery $query): UserFindWorkEntryQueryResponse
    {
        return new UserFindWorkEntryQueryResponse(
            $this->finder->find(
                $query->workerId(),
                $query->limit(),
                $query->offset()
            )
        );
    }
}
