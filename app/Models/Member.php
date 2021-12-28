<?php

namespace App\Models;

use App\Data\MemberInfo;
use App\Data\MemberStatuses;
use App\Models\Builders\MemberQueryBuilder;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use JetBrains\PhpStorm\Pure;
use Spatie\LaravelData\Data;

/**
 * @property MemberInfo $info
 * @property MemberStatuses $statuses
 */
class Member extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'info' => 'json',
        'statuses' => 'json',
    ];

    public function set(string $key, $value)
    {
        $data = $this->toArray();

        Arr::set($data, $key, $value);

        foreach ($data as $dataKey => $dataValue) {
            if (! str_contains($key, $dataKey)) {
                continue;
            }

            $this->{$dataKey} = $dataValue;
        }

        return $this;
    }

    #[Pure] public function newEloquentBuilder($query): MemberQueryBuilder
    {
        return new MemberQueryBuilder($query);
    }

    public static function findByExternalId($id)
    {
        return static::query()
            ->firstWhere('info->external_id', $id);
    }

    public function like($search)
    {
        $search = strtolower($search);

        if (str_contains(strtolower($this->info->name), $search)) {
            return true;
        }

        if (str_contains(strtolower($this->info->email), $search)) {
            return true;
        }

        if (str_contains(strtolower($this->info->phone), $search)) {
            return true;
        }

        if (str_contains(strtolower($this->info->status), $search)) {
            return true;
        }

        if (str_contains(strtolower($this->statuses->visited_at?->format('d-m-Y')), $search)) {
            return true;
        }

        if (str_contains(strtolower($this->statuses->called_at?->format('d-m-Y')), $search)) {
            return true;
        }

        if (str_contains(strtolower($this->statuses->mailed_at?->format('d-m-Y')), $search)) {
            return true;
        }

        if (str_contains(strtolower($this->statuses->other), $search)) {
            return true;
        }

        return false;
    }
}
