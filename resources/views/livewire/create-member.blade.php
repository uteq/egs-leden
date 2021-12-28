<div class="max-w-3xl mx-auto">
    <h1 class="text-xl mb-4">
        Lid of vaste bezoeker toevoegen
    </h1>

    <livewire:livewire.resource-form
        wire:key="add-member-form"
        name="add-member-form"
        :resource="\App\Move\Member::class"
        :model="new \App\Move\Member::$model()"
        hide-actions
    />

    <div class="flex justify-between bg-white border p-4 shadow rounded mt-2 items-center">
        <x-move-secondary-button wire:click="toDashboard">
            Annuleren
        </x-move-secondary-button>

        <x-move-button form="add-member-form">
            {{ \App\Move\Member::class::singularLabel() }} toevoegen
        </x-move-button>
    </div>

</div>
