<?php declare(strict_types=1);

namespace App\Tests\WorkEntry\Application\Create;

use App\Shared\Application\Event\DomainEventPublisher;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use App\Tests\WorkEntry\Infrastructure\Repository\InMemoryWorkEntryRepository;
use App\WorkEntry\Application\Create\CreateWorkEntryCommand;
use App\WorkEntry\Application\Create\CreateWorkEntryCommandHandler;
use App\WorkEntry\Domain\Creator\WorkEntryCreator;

final class CreateWorkEntryCommandHandlerTest extends UnitTestCase
{
    private InMemoryWorkEntryRepository $repository;
    private CreateWorkEntryCommandHandler $handler;

    protected function setUp(): void
    {
        $this->repository = new InMemoryWorkEntryRepository();
        $this->handler = new CreateWorkEntryCommandHandler(
            new WorkEntryCreator($this->repository),
            $this->createMock(DomainEventPublisher::class),
        );
    }

    public function testGivenDataWhenCreateWorkEntryThenThrowException(): void
    {
        $this->expectException(\Throwable::class);
        $this->handler->__invoke(new CreateWorkEntryCommand(
            'invalid-uuid'
        ));
    }
}
