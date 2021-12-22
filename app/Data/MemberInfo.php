<?php

namespace App\Data;

class MemberInfo extends Data
{
    public function __construct(
        public ?int $external_id,
        public ?string $external_source,
        public ?string $name,
        public ?string $status,
        public ?string $address,
        public ?string $email,
        public ?string $phone,
    )
    {

    }
}
