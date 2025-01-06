<?php declare(strict_types=1);

namespace App\WorkEntry\Application\User\Find;

use App\Shared\Application\Query\QueryResponseInterface;

final readonly class UserFindWorkEntryQueryResponse implements QueryResponseInterface
{
    public function __construct(private array $data)
    {
    }

    public function data(): array
    {
        return $this->data;
    }
}
