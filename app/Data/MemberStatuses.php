<?php

namespace App\Data;

use Illuminate\Support\Carbon;

class MemberStatuses extends Data
{
    public function __construct(
        public ?Carbon $visited_at = null,
        public ?Carbon $called_at = null,
        public ?Carbon $mailed_at = null,
        public ?string $other = null,
    )
    {

    }
}
