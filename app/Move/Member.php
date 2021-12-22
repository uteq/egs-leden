<?php

namespace App\Move;

use Uteq\Move\Fields\ID;
use Uteq\Move\Fields\Text;
use Uteq\Move\Resource;
use Uteq\Move\TableActions\ExportToExcelAction;

class Member extends Resource
{
    public static string $model = \App\Models\Member::class;

    public static string $title = 'id';

    public static array $search = [
        'info->name',
        'info->street',
        'info->email',
        'info->phone'
    ];

    public static string $group = 'Resources';

    public function fields()
    {
        return [
            Text::make('Naam', 'info.name')
                ->index(fn ($field) => dd($field->resource->info->name))
                ->sortable(),
        ];
    }

    public function filters()
    {
        return [];
    }

    public function actions()
    {
        return [
            new ExportToExcelAction
        ];
    }
}
