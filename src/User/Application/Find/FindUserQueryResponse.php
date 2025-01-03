<?php declare(strict_types=1);

namespace App\User\Application\Find;

use App\Shared\Application\Query\QueryResponseInterface;

final readonly class FindUserQueryResponse implements QueryResponseInterface
{
    public function __construct(private array $data)
    {
    }

    public function data(): array
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
        ];
    }
}
