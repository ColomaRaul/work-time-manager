<?php declare(strict_types=1);

namespace App\User\Infrastructure\Api\Update;

final class UpdateUserRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Name is required')]
        #[Assert\Length(min: 6, max: 36)]
        public string $name,
        #[Assert\NotBlank(message: 'Email is required')]
        #[Assert\Email]
        public string $email,
        #[Assert\NotBlank(message: 'Password is required')]
        #[Assert\Length(min: 6, max: 36)]
        public string $password,
    ) {
    }
}
