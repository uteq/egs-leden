<div class="max-w-3xl mx-auto rounded flex flex-col" wire:target="updatingStatus" wire:loading.class="opacity-50">

    <h1 class="text-xl mb-4">Leden</h1>

    <input type="text" wire:model="search" class="border rounded" placeholder="Zoek op naam, adres, e-mail, telefoonummer of datum dag-maand-jaar" />

    <div class="bg-white rounded-lg shadow-lg mt-4 overflow-hidden" wire:target="search" wire:loading.class="opacity-50">
        <div class="font-bold grid grid-cols-8 border-b px-4 py-2 w-full bg-gray-200">
            <div class="col-span-3">Naam</div>
            <div>Bezoek</div>
            <div>Telefoon</div>
            <div>Kaart</div>
            <div class="col-span-2">Overig</div>
        </div>

        <div class="flex flex-col">
        @foreach ($members as $key => $member)
            <div wire:key="member-{{ $member->id }}" class="grid grid-cols-8 px-4 py-2 border-b group">
                <div x-data="{ infoOpen : false }" class="col-span-3">
                    <div x-on:click="infoOpen = ! infoOpen" class="hover:underline cursor-pointer flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        {{ $member->info->name }}
                    </div>

                    <div x-show="infoOpen" class="text-sm text-gray-700 leading-6 my-4 pl-6" x-cloak>
                        <div class="flex gap-1 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ $member->info->address }}
                        </div>
                        <div class="flex gap-1 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ $member->info->email }}
                        </div>
                        <div class="flex gap-1 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            {{ $member->info->phone }}
                        </div>
                        <div class="flex gap-1 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            {{ $member->info->status }}
                        </div>
                    </div>
                </div>

                @include('livewire.partials.member-register-status', [
                    'status' => 'visited_at',
                    'description' => 'Bezoek',
                ])

                @include('livewire.partials.member-register-status', [
                    'status' => 'called_at',
                    'description' => 'Telefoon',
                ])

                @include('livewire.partials.member-register-status', [
                    'status' => 'mailed_at',
                    'description' => 'Kaart',
                ])

                <div class="col-span-2 member-edit-status"
                     wire:key="members-{{ $member->id }}-statuses-other"
                     x-data="{ editing : @entangle('editing') }"
                >
                    <div x-show="editing != '{{ $member->statuses->other }}'"
                         x-cloak
                         class="flex gap-2 items-center"
                    >
                        <div class="group-hover:block {{ $this->editing == $member->id ? null : 'hidden' }}">
                            @if ($this->editing == $member->id)
                                <x-move-button type="button" wire:click="$set('editing', null)">Opslaan</x-move-button>
                            @else
                                <div x-on:click="editing = '{{ $member->id }}'">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-6 w-6 cursor-pointer hover:text-primary-500"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                    >
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                        />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div x-on:click="editing = '{{ $member->id }}'"
                             x-show="editing == null"
                        >
                            {!! $member->statuses->other !!}
                        </div>
                    </div>
                    <div x-show="editing === '{{ $member->id }}'" x-cloak>
                        @if ($this->editing == $member->id)
                        <x-move-field.editor
                            id="member{{ $member->id }}other"
                            wire:model="members.{{ $member->id }}.statuses.other"
                            :value="collect($members->toArray())->mapWithKeys(fn ($member) => [$member['id'] => $member])"
                            :toolbar="[]"
                        ></x-move-field.editor>
                        @else
                            <svg class="animate-spin h-5 w-5 mr-3 ..." viewBox="0 0 24 24">
                                <!-- ... -->
                            </svg>
                            Aan het laden...
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <x-move-dialog-modal wire:model="updatingStatus">
        <x-slot name="title">
            @if (!empty($statusPayload))
                {{ $statusPayload['description'] }} voor {{ $statusPayload['member']['info']['name'] }}
            @else
                Aan het laden...
            @endif
        </x-slot>

        <x-slot name="content">
            @if ($statusPayload)
            <div>
                Registreer {{ $statusPayload['description'] }} voor <b>{{ $statusPayload['member']['info']['name'] }}</b>
            </div>

            <x-move-field.date
                wire:model="statusPayload.date"
                :config="[
                    'dateFormat' => 'd-m-Y',
               ]"
            ></x-move-field.date>
            @else
                <svg class="animate-spin h-5 w-5 mr-3 ..." viewBox="0 0 24 24">
                    <!-- ... -->
                </svg>
                Aan het laden...
            @endif
        </x-slot>

        <x-slot name="footer">
            @if ($statusPayload)
                <x-move-secondary-button
                    type="button"
                    wire:click="$set('updatingStatus', null)"
                >Annuleren</x-move-secondary-button>

                <x-move-button
                    type="button"
                    wire:click="updateStatus('{{ $statusPayload['member']['id'] }}', '{{ $statusPayload['status'] }}')"
                >Opslaan</x-move-button>
            @endif
        </x-slot>
    </x-move-dialog-modal>
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
