<div class="text-xs flex-inline"
     wire:loading.class="opacity-50"
     wire:target="registerStatus('{{ $member->id }}', '{{ $status }}', '{{ $description }}')"
>
    @if ($member->statuses->{$status .'_at'} ?? null)
        <div class="flex gap-0.5 items-center">
            <button
                type="button"
                class="hover:underline cursor-pointer mt-1"
                wire:click="registerStatus('{{ $member->id }}', '{{ $status }}', '{{ $description }}')"
            >
                {{ $member->statuses->{$status .'_at'}?->format('d-m-Y') }}
            </button>
            @if ($member->statuses->{$status .'_note'} ?? null)
                <span class="text-gray-500 mt-0.5">i</span>
            @endif
        </div>
    @else
        <button
            type="button"
            class="border px-1 py-0.5 rounded hidden group-hover:block"
            wire:click="registerStatus('{{ $member->id }}', '{{ $status }}', '{{ $description }}')"
        >
            Registreer
        </button>
    @endif
</div>
