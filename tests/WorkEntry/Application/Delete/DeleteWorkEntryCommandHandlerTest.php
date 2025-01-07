<?php declare(strict_types=1);

namespace App\Tests\WorkEntry\Application\Delete;

use App\Shared\Application\Event\DomainEventPublisher;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\Tests\WorkEntry\Infrastructure\Repository\InMemoryWorkEntryRepository;
use App\WorkEntry\Application\Delete\DeleteWorkEntryCommand;
use App\WorkEntry\Application\Delete\DeleteWorkEntryCommandHandler;
use App\WorkEntry\Domain\Deleter\WorkEntryDeleter;

final class DeleteWorkEntryCommandHandlerTest extends UnitTestCase
{
    private InMemoryWorkEntryRepository $repository;
    private DeleteWorkEntryCommandHandler $handler;

    protected function setUp(): void
    {
        $this->repository = new InMemoryWorkEntryRepository();
        $this->handler = new DeleteWorkEntryCommandHandler(
            new WorkEntryDeleter($this->repository),
            $this->createMock(DomainEventPublisher::class),
        );
    }

    public function testGivenDataWhenDeleteWorkEntryThenReturnOk(): void
    {
        $workEntry = WorkEntryMother::create();
        $this->repository->save($workEntry);

        $this->handler->__invoke(new DeleteWorkEntryCommand(
            $workEntry->id()->value(),
        ));

        $workEntryDeleted = $this->repository->byId($workEntry->id()->value());
        $this->assertNotNull($workEntryDeleted->deletedAt());
    }

    public function testGivenDataWhenDeleteWorkEntryThatNotExistsThenThrowException(): void
    {
        $this->expectException(\Throwable::class);
        $workEntry = WorkEntryMother::create();

        $this->handler->__invoke(new DeleteWorkEntryCommand(
            $workEntry->id()->value(),
        ));
    }
}
