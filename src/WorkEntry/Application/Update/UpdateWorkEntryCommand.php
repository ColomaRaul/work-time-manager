<?php declare(strict_types=1);

namespace App\WorkEntry\Application\Update;

use App\Shared\Application\Command\CommandInterface;

final class UpdateWorkEntryCommand implements CommandInterface
{
    public function __construct(
        public string $id,
        public string $userId,
        public string $startDate,
        public ?string $endDate,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function startDate(): string
    {
        return $this->startDate;
    }

    public function endDate(): ?string
    {
        return $this->endDate;
    }
}
