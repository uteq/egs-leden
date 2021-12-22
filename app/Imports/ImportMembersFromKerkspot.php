<?php

namespace App\Imports;

use App\Data\MemberInfo;
use App\Data\MemberStatuses;
use App\Models\Member;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMembersFromKerkspot implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $member = Member::findByExternalId($row['lidnummer']) ?: new Member();
        $member->info = new MemberInfo(
            external_id: $row['lidnummer'],
            external_source: 'kerkspot',
            name: Str::of($row['roepnaam'] . ' ' . $row['tussenvoegsel'] . ' ' . $row['achternaam'])
                ->trim()
                ->replaceMatches('/\xc2\xa0/', ' ')
                ->replaceMatches('/\s+/', ' '),
            status: $row['lidstatus'],
            address: $row['straatnaam'] . ' ' . $row['postcode'] . ' ' . $row['woonplaats'],
            email: $row['email'],
            phone: Str::of($row['telefoon'] . ' ' . $row['mobiel'])
                ->ltrim()
                ->rtrim()
                ->replaceMatches('/\xc2\xa0/', ' ')
                ->replaceMatches('/\s+/', ' ')
                ->trim(),
        );
        $member->statuses ??= new MemberStatuses();
        $member->save();
    }
}
