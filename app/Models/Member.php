<?php

namespace App\Models;

use App\Data\MemberInfo;
use App\Data\MemberStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property MemberInfo $info
 * @property MemberStatuses $statuses
 */
class Member extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'info' => MemberInfo::class,
        'statuses' => MemberStatuses::class,
    ];

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
