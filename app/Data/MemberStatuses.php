<?php

namespace App\Data;

use App\Data\Casts\DateCast;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\WithCast;

class MemberStatuses extends Data
{
    public function __construct(
        #[WithCast(DateCast::class)]
        public ?Carbon $visited_at = null,

        public ?string $visited_note = null,

        #[WithCast(DateCast::class)]
        public ?Carbon $called_at = null,

        public ?string $called_note = null,

        #[WithCast(DateCast::class)]
        public ?Carbon $mailed_at = null,

        public ?string $mailed_note = null,

        public ?string $other = null,
    )
    {

    }
}
