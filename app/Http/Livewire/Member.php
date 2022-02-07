<?php

namespace App\Http\Livewire;

use App\Data\MemberInfo;
use App\Data\MemberStatuses;
use App\Models\Member as MemberModel;
use Illuminate\Support\Str;
use Livewire\Component;

class Member extends Component
{
    public ?string $editing = null;
    public ?string $removingMember = null;

    public int $memberId;

    public ?MemberModel $member;

    public array $statusPayload = [];

    public ?string $updatingStatus = null;

    protected array $rules = [
        'member.statuses.other' => '',
    ];

    public function mount($member)
    {
        $this->memberId = $member->id;
    }

    public function updatedMember($value, $key)
    {
        $this->member->refresh();
        $this->member->set($key, $value);
        $this->member->save();
    }

    public function registerStatus(MemberModel $member, string $status, string $description)
    {
        $this->statusPayload = [
            'member' => $member->toArray(),
            'status' => $status,
            'description' => $description,
            'date' => (string) Str::of($member->statuses[$status .'_at'] ?? '')->before('T'),
            'note' => $member->statuses[$status . '_note'] ?? null,
        ];

        $this->updatingStatus = true;

        $this->emit('updatedStatusPayload', $this->statusPayload);
    }

    public function updateStatus(MemberModel $member, string $status)
    {
        $date = $this->statusPayload['date'];

        $statuses = $member->statuses;
        $statuses[$status .'_at'] = $date ? now()->parse($date)->format('Y-m-d') : null;
        $statuses[$status .'_note'] = $this->statusPayload['note'] ?? null;

        $member->statuses = $statuses;
        $member->save();

        $this->updatingStatus = false;
    }

    public function remove(MemberModel $member)
    {
        $member->delete();

        $this->emit('memberRemoved');
    }

    public function render()
    {
        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->member = MemberModel::query()
            ->withCasts([
                'info' => MemberInfo::class,
                'statuses' => MemberStatuses::class,
            ])
            ->find($this->memberId);

        return view('livewire.member', [
            'statusPayload' => $this->statusPayload,
        ]);
    }
}
