<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class Members extends Component
{
    public ?string $search = null;

    /** @var Collection<Member>|null */
    public Collection|null $members = null;

    public array $store = [];

    public ?string $editing = null;

    public ?string $updatingStatus = null;

    public array $statusPayload = [];

    protected array $rules = [
        'members.*.statuses.other' => '',
    ];

    public function updatedMembers($value, $key)
    {
        $id = (int) (string) Str::of($key)
            ->before('.');

        $member = $this->members
            ->filter(fn ($member) => $member->id === $id)
            ->first();

        $data = $member->toArray();
        unset($data['id']);
        Arr::set($data, Str::of($key)->after('.'), $value);

        $member->fill($data)->save();
    }

    public function getMembers()
    {
        return Member::query()
            ->get()
            ->when($this->search, function (Collection $members) {
                return $members->filter(fn ($member) => $member->like($this->search));
            })
            ->mapWithKeys(fn ($member) => [$member->id => $member]);
    }

    public function registerStatus(Member $member, string $status, string $description)
    {
        $this->statusPayload = [
            'member' => $member->toArray(),
            'status' => $status,
            'description' => $description,
            'date' => $member->statuses->{$status}?->format('d-m-Y'),
        ];

        $this->updatingStatus = true;
    }

    public function updateStatus(Member $member, string $status)
    {
        $date = $this->statusPayload['date'];

        $statuses = $member->statuses;
        $statuses->{$status} = $date ? now()->parse($date) : null;

        $member->save();

        $this->updatingStatus = false;
    }

    public function render()
    {
        $this->members = $this->getMembers();

        return view('livewire.members', [
                'members' => $this->members,
                'statusPayload' => $this->statusPayload,
                'updatingStatus' => $this->updatingStatus,
            ])
            ->layout('layouts.app', [
                'header' => null,
            ]);
    }
}
