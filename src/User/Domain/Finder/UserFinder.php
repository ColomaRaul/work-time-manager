<?php declare(strict_types=1);

namespace App\User\Domain\Finder;

use App\User\Domain\UserRepositoryInterface;

final class UserFinder
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function find(
        ?string $name,
        ?string $email,
        ?string $orderBy,
        ?string $order,
        ?int $limit,
        ?int $offset
    ): array {
        return $this->repository->byCriteria(
            new UserCriteria(
                $name,
                $email,
                $orderBy,
                $order,
                $limit,
                $offset
            )
        );
    }
}
