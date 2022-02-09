<div class="p-4 {{ $hasMaxWidth ? 'max-w-5xl mx-auto bg-white p-8 rounded-xl shadow' : null }}">
    <h1 class="text-3xl">Leden importeren</h1>

    @unless ($done)

        <x-move-alert color="red" class="my-4">
            <b>LET OP</b>
            <p>Hiermee wordt de bestaande lijst met leden overschreven. Deze actie kan niet ongedaan worden gemaakt.</p>
        </x-move-alert>

        <form wire:submit.prevent="import">

            <div class="border p-3">

                <input type="file" wire:model="file" >

                @error('file') <span class="error">{{ $message }}</span> @enderror

                <div wire:loading wire:target="file">Uploading...</div>

            </div>

            <div class="flex flex-col" wire:loading.remove wire:target="import">
                <button
                    type="submit"
                    class="self-end bg-primary-600 border px-2 py-1 rounded  mt-1 text-white {{ $file ? null : 'opacity-50 bg-gray-500 cursor-default' }}"
                    {{ $this->hasFile() ? null : 'disabled' }}
                >
                    Importeer
                </button>
            </div>

        </form>

    @else

        <x-move-alert color="green" class="mt-2">
            Bestand is geüpload
        </x-move-alert>

        <div class="mt-4">
            @if ($report ?? null)
                {!! $report !!}
            @endif
        </div>

        <div class="flex flex-col" wire:key="done-button">
            <a
                class="self-end bg-primary-600 border px-2 py-1 rounded  mt-1 text-white"
                href="/dashboard"
            >
                Klaar
            </a>
        </div>

    @endif
</div>
