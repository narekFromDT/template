<?php

namespace Modules\AuthUser\Dto;

final class CreateUserDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $fullName,
        public readonly string $country,
        public readonly string $phoneNumber,
    )
    {
        //
    }
}
