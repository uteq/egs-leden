<?php

namespace App\Data\Casts;

use DateTimeInterface;
use Illuminate\Support\Str;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\DataProperty;

class DateCast extends DateTimeInterfaceCast
{
    public function cast(DataProperty $property, mixed $value): DateTimeInterface | Uncastable
    {
        $value = Str::of($value)->before('T');

        $this->format = 'Y-m-d';

        return parent::cast($property, $value);
    }
}
