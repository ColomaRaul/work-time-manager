<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Finisher;

use App\Shared\Domain\DomainActions;
use App\Shared\Domain\ValueObject\Uuid;
use App\WorkEntry\Domain\Exception\WorkEntryNotFoundException;
use App\WorkEntry\Domain\Exception\WorkEntryNotPermissionToFinishException;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;
use Throwable;

final class WorkEntryFinisher extends DomainActions
{
    public function __construct(private readonly WorkEntryRepositoryInterface $repository)
    {
    }

    public function finish(Uuid $workEntryId, Uuid $userId): void
    {
        try {
            $workEntry = $this->repository->byId($workEntryId->value());
        } catch (Throwable $e) {
            throw new WorkEntryNotFoundException();
        }

        if (!$workEntry->userId()->equals($userId) ) {
            throw new WorkEntryNotPermissionToFinishException();
        }

        $workEntry->finish();
        $this->repository->save($workEntry);

        $this->publishedEvents = $workEntry->pullDomainEvents();
    }
}
