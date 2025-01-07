<?php declare(strict_types=1);

namespace App\Tests\WorkEntry\Application\User\Finish;

use App\Shared\Application\Event\DomainEventPublisher;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use App\Tests\User\Application\User\Finish\WorkEntryT;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\Tests\WorkEntry\Domain\WorkEntryTimeMother;
use App\Tests\WorkEntry\Infrastructure\Repository\InMemoryWorkEntryRepository;
use App\WorkEntry\Application\User\Finish\UserFinishWorkEntryCommand;
use App\WorkEntry\Application\User\Finish\UserFinishWorkEntryCommandHandler;
use App\WorkEntry\Domain\Exception\WorkEntryIsFinishedException;
use App\WorkEntry\Domain\Finisher\WorkEntryFinisher;

final class UserFinishWorkEntryCommandHandlerTest extends UnitTestCase
{
    private InMemoryWorkEntryRepository $repository;
    private UserFinishWorkEntryCommandHandler $handler;

    protected function setUp(): void
    {
        $this->repository = new InMemoryWorkEntryRepository();
        $this->handler = new UserFinishWorkEntryCommandHandler(
            new WorkEntryFinisher($this->repository),
            $this->createMock(DomainEventPublisher::class),
        );
    }

    public function testGivenDataWhenFinishWorkEntryThenReturnOk(): void
    {
        $workEntry = WorkEntryMother::create();
        $this->repository->save($workEntry);

        $this->handler->__invoke(new UserFinishWorkEntryCommand(
            $workEntry->id()->value(),
            $workEntry->userId()->value(),
        ));

        $workEntryFinished = $this->repository->byId($workEntry->id()->value());
        $this->assertNotNull($workEntryFinished->workEntryTime()->end());
        $this->assertFalse($workEntryFinished->workEntryTime()->isWorking());
    }

    public function testGivenDataWhenFinishWorkWithWorkEntryAlreadyFinishedThenReturnException(): void
    {
        $this->expectException(WorkEntryIsFinishedException::class);
        $workEntryTime = WorkEntryTimeMother::create(end: new \DateTimeImmutable());
        $workEntry = WorkEntryMother::create(workEntryTime: $workEntryTime);
        $this->repository->save($workEntry);

        $this->handler->__invoke(new UserFinishWorkEntryCommand(
            $workEntry->id()->value(),
            $workEntry->userId()->value(),
        ));
    }
}
