<?php declare(strict_types=1);

namespace App\Tests\User\Application\Update;

use App\Shared\Application\Event\DomainEventPublisher;
use App\Shared\Infrastructure\Security\PasswordHasher;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use App\Tests\User\Domain\UserMother;
use App\Tests\User\Infrastructure\Repository\InMemoryUserRepository;
use App\User\Application\Update\UpdateUserCommand;
use App\User\Application\Update\UpdateUserCommandHandler;
use App\User\Domain\Updater\UserUpdater;

final class UpdateUserCommandHandlerTest extends UnitTestCase
{
    private UpdateUserCommandHandler $handler;
    private InMemoryUserRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new InMemoryUserRepository();
        $this->handler = new UpdateUserCommandHandler(
            new UserUpdater($this->repository, $this->createMock(PasswordHasher::class)),
            $this->createMock(DomainEventPublisher::class),
        );
    }

    public function testGivenDataWhenUpdateAllValuesThenReturnOk(): void
    {
        $user = UserMother::create();
        $this->repository->save($user);

        $this->handler->__invoke(new UpdateUserCommand(
            $user->id()->value(),
            'user-name',
            'user-email@newmail.com',
            'user-password',
        ));

        $updatedUser = $this->repository->byId($user->id()->value());
        $this->assertEquals('user-name', $updatedUser->name());
        $this->assertEquals('user-email@newmail.com', $updatedUser->email()->value());
    }

    public function testGivenIncorrectDataWhenUpdateValuesThenThrownException(): void
    {
        $this->expectException(\Throwable::class);
        $user = UserMother::create();
        $this->repository->save($user);

        $this->handler->__invoke(new UpdateUserCommand(
            $user->id()->value(),
            'user-name',
            'user-email-wrong',
            'user-password',
        ));
    }

    public function testGivenDataWhenUpdateNonExistUserThenThrowException(): void
    {
        $this->expectException(\Throwable::class);
        $user = UserMother::create();

        $this->handler->__invoke(new UpdateUserCommand(
            $user->id()->value(),
            'user-name',
            'user-email@newmail.com',
            'user-password',
        ));
    }
}
