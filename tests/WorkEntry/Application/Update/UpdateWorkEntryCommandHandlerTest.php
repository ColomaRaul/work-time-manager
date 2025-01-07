<?php declare(strict_types=1);

namespace App\Tests\WorkEntry\Application\Update;

use App\Shared\Application\Event\DomainEventPublisher;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\Tests\WorkEntry\Infrastructure\Repository\InMemoryWorkEntryRepository;
use App\WorkEntry\Application\Update\UpdateWorkEntryCommand;
use App\WorkEntry\Application\Update\UpdateWorkEntryCommandHandler;
use App\WorkEntry\Domain\Updater\WorkEntryUpdater;

final class UpdateWorkEntryCommandHandlerTest extends UnitTestCase
{
    private InMemoryWorkEntryRepository $repository;
    private UpdateWorkEntryCommandHandler $handler;

    protected function setUp(): void
    {
        $this->repository = new InMemoryWorkEntryRepository();
        $this->handler = new UpdateWorkEntryCommandHandler(
            new WorkEntryUpdater($this->repository),
            $this->createMock(DomainEventPublisher::class),
        );
    }

    public function testGivenDataWhenUpdateAllValuesThenReturnOk(): void
    {
        $workEntry = WorkEntryMother::create();
        $this->repository->save($workEntry);
        $newUserId = Uuid::random();
        $startDate = '2024-01-18 08:00:00';
        $endDate = '2024-01-18 17:00:00';

        $this->handler->__invoke(new UpdateWorkEntryCommand(
            $workEntry->id()->value(),
            $newUserId->value(),
            $startDate,
            $endDate,
        ));

        $updatedWorkEntry = $this->repository->byId($workEntry->id()->value());
        $this->assertEquals($updatedWorkEntry->workEntryTime()->start()->format('Y-m-d H:i:s'), $startDate);
        $this->assertEquals($updatedWorkEntry->workEntryTime()->end()->format('Y-m-d H:i:s'), $endDate);
        $this->assertEquals($updatedWorkEntry->userId()->value(), $newUserId->value());
    }

    public function testGivenWrongDataWhenUpdateValuesThenThrowException(): void
    {
        $this->expectException(\Throwable::class);
        $this->handler->__invoke(new UpdateWorkEntryCommand(
            'invalid-uuid',
            'invalid-uuid',
            'invalid-date',
            'invalid-date',
        ));
    }

    public function testGivenDataWhenUpdateWithNonWorkEntryExistsThenThrowException(): void
    {
        $workEntry = WorkEntryMother::create();
        $this->expectException(\Throwable::class);

        $this->handler->__invoke(new UpdateWorkEntryCommand(
            $workEntry->id()->value(),
            $workEntry->userId()->value(),
            '2024-01-18 08:00:00',
            '2024-01-18 17:00:00',
        ));
    }
}
