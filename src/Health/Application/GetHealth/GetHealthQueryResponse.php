<?php declare(strict_types=1);

namespace App\Health\Application\GetHealth;

use App\Shared\Application\Query\QueryResponseInterface;

final readonly class GetHealthQueryResponse implements QueryResponseInterface
{
    public function __construct(private string $status, private array $data)
    {
    }

    public function status(): string
    {
        return $this->status;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'data' => $this->data,
        ];
    }
}
