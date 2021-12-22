<div class="text-xs"
     wire:click="registerStatus('{{ $member->id }}', '{{ $status }}', '{{ $description }}')"
     x-on:click="updatingStatus = true"
>
    @if ($member->statuses->{$status})
        <button
            type="button"
            class="hover:underline cursor-pointer mt-1"
        >
            {{ $member->statuses->{$status}?->format('d-m-Y') }}
        </button>
    @else
        <button
            type="button"
            class="border px-1 py-0.5 rounded hidden group-hover:block"
        >
            Registreer
        </button>
    @endif
</div>
