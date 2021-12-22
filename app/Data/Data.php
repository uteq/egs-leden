<?php

namespace App\Data;

use Livewire\Wireable;

class Data extends \Spatie\LaravelData\Data implements Wireable
{
    public function toLivewire()
    {
        return $this->toArray();
    }

    public static function fromLivewire($value)
    {
        return static::from($value);
    }
}
