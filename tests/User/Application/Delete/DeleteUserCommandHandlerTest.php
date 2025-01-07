<?php declare(strict_types=1);

namespace App\Tests\User\Application\Delete;

use App\Shared\Application\Event\DomainEventPublisher;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use App\Tests\User\Domain\UserMother;
use App\Tests\User\Infrastructure\Repository\InMemoryUserRepository;
use App\User\Application\Delete\DeleteUserCommand;
use App\User\Application\Delete\DeleteUserCommandHandler;
use App\User\Domain\Deleter\UserDeleter;

final class DeleteUserCommandHandlerTest extends UnitTestCase
{
    private DeleteUserCommandHandler $handler;
    private InMemoryUserRepository $repository;

    public function setUp(): void
    {
        $this->repository = new InMemoryUserRepository();
        $this->handler = new DeleteUserCommandHandler(
            new UserDeleter($this->repository),
            $this->createMock(DomainEventPublisher::class),
        );
    }

    public function testGivenDataWhenExecuteHandlerThenReturnOk(): void
    {
        $user = UserMother::create();
        $this->repository->save($user);

        $this->handler->__invoke(new DeleteUserCommand($user->id()->value()));

        $user = $this->repository->byId($user->id()->value());
        $this->assertTrue($user->isDeleted());
    }

    public function testGivenUserNotFoundWhenExecuteHandlerThenThrowException(): void
    {
        $this->expectException(\Exception::class);
        $user = UserMother::create();

        $this->handler->__invoke(new DeleteUserCommand($user->id()->value()));
    }
}
