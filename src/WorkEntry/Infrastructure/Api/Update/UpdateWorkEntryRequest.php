<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Api\Update;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateWorkEntryRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'User id is required')]
        #[Assert\Length(min: 6, max: 36)]
        public string $userId,
        #[Assert\NotBlank(message: 'Start date is required')]
        #[Assert\DateTime(format: 'Y-m-d H:i:s')]
        public string $startDate,
        #[Assert\DateTime(format: 'Y-m-d H:i:s', message: 'End date must be a valid date')]
        public ?string $endDate = null,
    ) {
    }
}
