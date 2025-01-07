<?php declare(strict_types=1);

namespace App\Tests\User\Application\Create;

use App\Shared\Application\Event\DomainEventPublisher;
use App\Shared\Infrastructure\Security\PasswordHasher;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use App\Tests\User\Infrastructure\Repository\InMemoryUserRepository;
use App\User\Application\Create\CreateUserCommand;
use App\User\Application\Create\CreateUserCommandHandler;
use App\User\Domain\Creator\UserCreator;

final class CreateUserCommandHandlerTest extends UnitTestCase
{
    private InMemoryUserRepository $repository;
    private mixed $eventPublisher;
    private CreateUserCommandHandler $handler;

    protected function setUp(): void
    {
        $this->repository = new InMemoryUserRepository();
        $this->eventPublisher = $this->createMock(DomainEventPublisher::class);
        $this->handler = new CreateUserCommandHandler(
            new UserCreator($this->repository, $this->createMock(PasswordHasher::class)),
            $this->eventPublisher,
        );
    }

    public function testGivenDataWhenCreateUserWithIncorrectDataThenThrowException(): void
    {
        $this->expectException(\Exception::class);

        $this->handler->__invoke(new CreateUserCommand(
            'user-id',
            'user-email',
            'user-password',
        ));
    }
}
