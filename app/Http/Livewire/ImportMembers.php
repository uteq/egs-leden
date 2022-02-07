<?php

namespace App\Http\Livewire;

use App\Imports\ImportMembersFromKerkspot;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Excel;

class ImportMembers extends Component
{
    use WithFileUploads;

    public $file;

    public bool $done = false;

    public bool $hasMaxWidth = true;

    protected ?ImportMembersFromKerkspot $importer = null;

    public function import()
    {
        $this->validate([
            'file' => 'mimes:csv,xlsx,xls,txt|max:8024', // 8MB Max
        ]);

        \App\Models\Member::query()->delete();

        $this->importer = new ImportMembersFromKerkspot();

        $readerType = match ($this->file->guessExtension()) {
            'txt' => Excel::CSV,
            'csv' => Excel::CSV,
            default => null,
        };

        \Maatwebsite\Excel\Facades\Excel::import(
            import: $this->importer,
            filePath: $this->file->getRealPath(),
            readerType: $readerType
        );

        $this->done = true;
    }

    public function hasFile()
    {
        return (bool) ($this->file ?? false);
    }

    public function done()
    {
        $this->emit('closeModal');
    }

    public function render()
    {
        return view('livewire.import-members');
    }
}
