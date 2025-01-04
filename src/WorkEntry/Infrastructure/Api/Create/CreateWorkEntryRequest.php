<?php declare(strict_types=1);

namespace App\WorkEntry\Infrastructure\Api\Create;

use Symfony\Component\Validator\Constraints as Assert;


final readonly class CreateWorkEntryRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'User id is required')]
        #[Assert\Length(max: 36)]
        public string $userId
    )
    {
    }
}
