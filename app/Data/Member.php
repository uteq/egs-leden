<?php

namespace App\Data;

use Spatie\LaravelData\DataCollection;

class Member extends Data
{
    public function __construct(
        public MemberInfo $info,
        public MemberStatuses $statuses,
    )
    {

    }
}
