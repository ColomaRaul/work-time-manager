<?php declare(strict_types=1);

namespace App\WorkEntry\Domain;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;

final class WorkEntry extends AggregateRoot implements \JsonSerializable
{
    public function __construct(
        private Uuid $id,
        private Uuid $userId,
        private WorkEntryTime $workEntryTime,
        private \DateTimeInterface $createdAt,
        private \DateTimeInterface $updatedAt,
        private ?\DateTimeInterface $deletedAt = null,
    ) {
    }

    public static function createWorkEntry(string $userId): self
    {
        $workEntry = new self(
            Uuid::random(),
            Uuid::from($userId),
            WorkEntryTime::initialize(),
            new DateTimeImmutable(),
            new DateTimeImmutable(),
        );

        // $workEntry->saveDomainEvent(); WorkEntryCreated

        return $workEntry;
    }

    public static function start(Uuid $workEntryId, Uuid $userId): self
    {
        $workEntry = new self(
            $workEntryId,
            $userId,
            WorkEntryTime::initialize(),
            new DateTimeImmutable(),
            new DateTimeImmutable(),
        );

        // $workEntry->saveDomainEvent(); WorkEntryStarted

        return $workEntry;
    }

    public function finish(): void
    {
        if (null !== $this->workEntryTime->end()) {
//            throw new WorkEntryIsFinished();
        }

        $this->workEntryTime = $this->workEntryTime()->updateEnd(new DateTimeImmutable());
        $this->updatedAt = new DateTimeImmutable();
        // $this->saveDomainEvent(); WorkEntryFinished
    }

    public function updateUserId(string $userId): void
    {
        if ($this->userId->value() === $userId) {
            return;
        }

        $this->userId = Uuid::from($userId);
        $this->updatedAt = new DateTimeImmutable();
        // $this->saveDomainEvent(); WorkEntryUserIdChanged
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function updateStartDate(string $startDate): void
    {
        if ($this->workEntryTime->start()->format('Y-m-d H:i:s') === $startDate) {
            return;
        }

        $this->workEntryTime = $this->workEntryTime->updateStart(new \DateTimeImmutable($startDate));
        $this->updatedAt = new DateTimeImmutable();
        // $this->saveDomainEvent(); WorkEntryStartDateChanged
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function updateEndDate(?string $endDate): void
    {
        if ($this->workEntryTime->end() === $endDate) {
            return;
        }

        if (null !== $this->workEntryTime->end()
            && $this->workEntryTime->end()->format('Y-m-d H:i:s') === $endDate) {
            return;
        }


        $this->workEntryTime = $this->workEntryTime->updateEnd(new \DateTimeImmutable($endDate));
        $this->updatedAt = new DateTimeImmutable();
        // $this->saveDomainEvent(); WorkEntryEndDateChanged
    }

    public function delete(): void
    {
        if (null !== $this->deletedAt) {
            return;
        }

        $this->deletedAt = new DateTimeImmutable();
        // $this->saveDomainEvent(); WorkEntryDeleted
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function userId(): Uuid
    {
        return $this->userId;
    }

    public function workEntryTime(): WorkEntryTime
    {
        return $this->workEntryTime;
    }

    public function createdAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->value(),
            'userId' => $this->userId->value(),
            'startAt' => $this->workEntryTime->start()->format(\DateTimeInterface::ATOM),
            'endAt' => null === $this->workEntryTime->end() ? '' :$this->workEntryTime->end()->format(\DateTimeInterface::ATOM),
        ];
    }
}
