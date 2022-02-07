<div class="max-w-5xl mx-auto rounded flex flex-col"
     wire:target="updatingStatus"
     wire:loading.class="opacity-50"
     wire:poll.10000ms
>
    <div class="flex items-center justify-between">
        <h1 class="text-xl py-4">
            Leden & vaste bezoekers
        </h1>

        <x-move-secondary-button wire:click="createMember">
            Lid toevoegen
        </x-move-secondary-button>
    </div>

    <input type="text" wire:model="search" class="border rounded" placeholder="Zoek op naam, adres, e-mail, telefoonummer of datum dag-maand-jaar" />

    <div class="bg-white rounded-lg shadow-lg mt-4 overflow-hidden" wire:target="search" wire:loading.class="opacity-50">
        <div class="font-bold grid grid-cols-8 border-b px-4 py-2 w-full bg-gray-200">
            <div class="col-span-3">Naam</div>
            <div>Bezoek</div>
            <div>Telefoon</div>
            <div>Kaart</div>
            <div class="col-span-2">Overig</div>
        </div>

        <div class="flex flex-col" wire:init="loadMembers" wire:key="members-{{ count($members) }}-{{ $version }}">
        @if (count($members))
            @foreach ($members as $key => $member)
                <livewire:member :member="$member" wire:key="member-{{ $member->id }}" />
            @endforeach
        @else ($this->readyToLoad)
            <div class="p-4 w-full mx-auto">
                <div class="animate-pulse flex space-x-4">
                    <div class="rounded-full bg-gray-200 h-10 w-10"></div>
                    <div class="flex-1 space-y-6 py-1">
                        <div class="h-2 bg-gray-200 rounded"></div>
                        <div class="space-y-3">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="h-2 bg-gray-200 rounded col-span-2"></div>
                                <div class="h-2 bg-gray-200 rounded col-span-1"></div>
                            </div>
                            <div class="h-2 bg-gray-200 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>

@push('styles')
    <style>
        .member-edit-status .ql-toolbar.ql-snow {
            display: none;
        }

        .member-edit-status .ql-container {
            border-top: 1px solid #ccc !important;
            border-radius: 5px;
        }
    </style>
@endpush
