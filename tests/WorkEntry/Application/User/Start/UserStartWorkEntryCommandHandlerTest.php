<?php declare(strict_types=1);

namespace App\Tests\WorkEntry\Application\User\Start;

use App\Shared\Application\Event\DomainEventPublisher;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\Tests\WorkEntry\Infrastructure\Repository\InMemoryWorkEntryRepository;
use App\WorkEntry\Application\User\Start\UserStartWorkEntryCommand;
use App\WorkEntry\Application\User\Start\UserStartWorkEntryCommandHandler;
use App\WorkEntry\Domain\Exception\UserHasWorkEntryActiveException;
use App\WorkEntry\Domain\Starter\WorkEntryStarter;

final class UserStartWorkEntryCommandHandlerTest extends UnitTestCase
{
    private InMemoryWorkEntryRepository $repository;
    private UserStartWorkEntryCommandHandler $handler;

    protected function setUp(): void
    {
        $this->repository = new InMemoryWorkEntryRepository();
        $this->handler = new UserStartWorkEntryCommandHandler(
            new WorkEntryStarter($this->repository),
            $this->createMock(DomainEventPublisher::class),
        );
    }

    public function testGivenDataWhenStartWorkEntryThenReturnOk(): void
    {
        $workEntry = WorkEntryMother::create();

        $this->handler->__invoke(new UserStartWorkEntryCommand(
            $workEntry->id()->value(),
            $workEntry->userId()->value(),
        ));

        $workEntryStarted = $this->repository->byId($workEntry->id()->value());
        $this->assertNull($workEntryStarted->workEntryTime()->end());
        $this->assertTrue($workEntryStarted->workEntryTime()->isWorking());
    }

    public function testGivenDataWhenStartEntryWorkWhenThereIsOtherActiveThenThrowException(): void
    {
        $this->expectException(UserHasWorkEntryActiveException::class);
        $workEntry = WorkEntryMother::create();
        $this->repository->save($workEntry);

        $this->handler->__invoke(new UserStartWorkEntryCommand(
            $workEntry->id()->value(),
            $workEntry->userId()->value(),
        ));
    }
}
