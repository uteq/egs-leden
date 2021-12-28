<?php

namespace App\Move;

use Illuminate\Support\Str;
use Uteq\Move\Fields\Date;
use Uteq\Move\Fields\ID;
use Uteq\Move\Fields\Text;
use Uteq\Move\Resource;
use Uteq\Move\TableActions\ExportToExcelAction;

class Member extends Resource
{
    public static string $model = \App\Models\Member::class;

    public static ?string $layout = 'layouts.app';

    public static string $title = 'id';

    public static ?int $defaultPerPage = 1000;

    public static array $search = [
        'info->name',
        'info->street',
        'info->email',
        'info->phone'
    ];

    public static function singularLabel(): string
    {
        return 'Lid';
    }

    public static function label(): string
    {
        return 'Leden';
    }

    public function fields()
    {
        return [
            Text::make('Naam', 'info.name')
                ->clickable(),

            Text::make('Lidstatus', 'info.status'),

            Text::make('Adres', 'info.address'),

            Text::make('Email', 'info.email'),

            Text::make('Telefoonummer', 'info.phone'),

            Date::make('Bezocht', 'statuses.visited_at'),

            Date::make('Gebeld', 'statuses.called_at'),

            Date::make('Kaart', 'statuses.mailed_at'),

            Date::make('Overig', 'statuses.other'),
        ];
    }

    public function filters()
    {
        return [];
    }

    public function redirects(): array
    {
        return [
            'create' => route('dashboard'),
            'update' => route('dashboard'),
            'cancel' => fn () => route('dashboard'),
        ];
    }

    public function actions()
    {
        return [
            new ExportToExcelAction
        ];
    }
}
