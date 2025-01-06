<?php declare(strict_types=1);

namespace App\Shared\Domain;

abstract class DomainActions
{
    protected array $publishedEvents = [];

    public function publishedEvents(): array
    {
        return $this->publishedEvents;
    }
}
