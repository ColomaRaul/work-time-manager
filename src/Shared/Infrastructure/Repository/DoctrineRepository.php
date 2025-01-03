<?php declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository;

use App\Shared\Domain\AggregateRoot;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    protected function persist(AggregateRoot $entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    protected function repository(string $entity): EntityRepository
    {
        return $this->entityManager->getRepository($entity);
    }
}
