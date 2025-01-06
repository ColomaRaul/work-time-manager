<?php declare(strict_types=1);

namespace App\WorkEntry\Domain\Finisher;

use App\Shared\Domain\ValueObject\Uuid;
use App\WorkEntry\Domain\WorkEntryRepositoryInterface;

final readonly class WorkEntryFinisher
{
    public function __construct(private WorkEntryRepositoryInterface $repository)
    {
    }

    public function finish(Uuid $workEntryId, Uuid $userId): void
    {
        try {
            $workEntry = $this->repository->byId($workEntryId->value());
        } catch (\Exception $e) {
            throw new \Exception('Error getting work entry');
        }

        if (!$workEntry->userId()->equals($userId) ) {
            throw new \Exception('User does not have permission to finish this work entry');
        }

        $workEntry->finish();
        $this->repository->save($workEntry);

        //TODO publish all events
    }
}
