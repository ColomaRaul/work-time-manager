<?php declare(strict_types=1);

namespace App\User\Infrastructure\Repository;

use App\Shared\Domain\Criteria\CriteriaInterface;
use App\Shared\Infrastructure\Repository\DoctrineRepository;
use App\User\Domain\User;
use App\User\Domain\UserRepositoryInterface;

final class PostgresUserRepository extends DoctrineRepository implements UserRepositoryInterface
{
    public function byId(string $id): ?User
    {
        return $this->repository(User::class)->find($id);
    }

    public function save(User $user): void
    {
        try {
            $this->persist($user);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function byCriteria(CriteriaInterface $criteria): array
    {
        return $this->repository(User::class)
            ->matching($criteria->convertToCriteriaDatabase())->toArray();
    }
}
