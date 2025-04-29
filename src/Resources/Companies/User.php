<?php

declare(strict_types=1);

namespace JustSteveKing\Sevalla\Resources\Companies;

final readonly class User
{
    public function __construct(
        public string $id,
        public string $email,
        public string $image,
        public string $full_name,
    ) {}
}
