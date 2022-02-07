<x-move-modal wire:model="showModal.import-members">
    <x-slot name="button">
            <span class="text-primary-500 cursor-pointer">
                {{ __('Importeer ledenbestand') }}
            </span>
    </x-slot>

    <livewire:import-members wire:key="import-members-modal"/>
</x-move-modal>
