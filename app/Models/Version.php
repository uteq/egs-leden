<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function up($subject)
    {
        $version = static::query()
            ->firstWhere('subject', $subject)
            ?: new static([
                'subject' => $subject,
                'version' => 0,
            ]);

        $version->version++;
        $version->save();
    }

    public static function version($subject)
    {
        return static::query()
            ->firstWhere('subject', $subject)
            ?->version ?: 0;
    }
}
