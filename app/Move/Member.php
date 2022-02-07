<?php

namespace App\Move;

use App\Move\Actions\ImportMembersFromKerkspotAction;
use Illuminate\Support\Str;
use Uteq\Move\Fields\Date;
use Uteq\Move\Fields\Editor;
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

    public function headerSlots($resourceTable): array
    {
        return [
            'beforeAdd' => view('move.member.import-members-modal', [
                'resource' => $resourceTable->resource(),
            ]),
        ];
    }

    public function fields()
    {
        return [
            Text::make('Naam', 'info.name')
                ->clickable(),

            Text::make('Lidstatus', 'info.status'),

            Text::make('Adres', 'info.address')->hideFromIndex(),

            Text::make('Email', 'info.email')->hideFromIndex(),

            Text::make('Telefoonummer', 'info.phone')->hideFromIndex(),

            Date::make('Bezocht', 'statuses.visited_at'),
            Editor::make('Bezocht Notitie', 'statuses.visited_note')->hideFromIndex(),

            Date::make('Gebeld', 'statuses.called_at'),
            Editor::make('Bellen Notitie', 'called.visited_note')->hideFromIndex(),

            Date::make('Kaart', 'statuses.mailed_at'),
            Editor::make('Kaart Notitie', 'called.mailed_note')->hideFromIndex(),

            Editor::make('Overig', 'statuses.other'),
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
            new ExportToExcelAction,
        ];
    }
}
