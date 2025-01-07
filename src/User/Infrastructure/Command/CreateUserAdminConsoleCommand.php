<?php declare(strict_types=1);

namespace App\User\Infrastructure\Command;

use App\Shared\Domain\ValueObject\Uuid;
use App\User\Application\Create\CreateUserAdminCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:create-user-admin',
    description: 'Create a new user admin',
)]
final class CreateUserAdminConsoleCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = Uuid::random()->value();
        $name = $io->ask('Name');
        $email = $io->ask('Email');
        $password = $io->ask('Password');

        $this->commandBus->dispatch(new CreateUserAdminCommand($id, $name, $email, $password));

        $output->writeln('User admin created successfully');
        $output->writeln('ID: ' . $id);

        return Command::SUCCESS;
    }
}
