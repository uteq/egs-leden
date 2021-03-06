<?php

namespace App\Http\Livewire;

use App\Data\MemberInfo;
use App\Data\MemberStatuses;
use App\Models\Member;
use App\Models\Version;
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

    public $readyToLoad = false;

    protected $listeners = [
        'memberRemoved' => 'render'
    ];

    public function loadMembers()
    {
        $this->readyToLoad = true;
    }

    public function updatedMembers($value, $key)
    {
        $id = (int) (string) Str::of($key)
            ->before('.');

        $path = str_replace($id . '.', '', $key);

        $member = $this->getMembers()->get($id);
        $member->set($path, $value);
        $member->save();
    }

    public function getMembers()
    {
        return Member::query()
            ->withCasts([
                'info' => MemberInfo::class,
                'statuses' => MemberStatuses::class,
            ])
            ->get()
            ->filter()
            ->when($this->search, function (Collection $members) {
                return $members->filter(fn ($member) => $member->search($this->search));
            })
            ->mapWithKeys(fn ($member) => [$member->id => $member]);
    }

    public function createMember()
    {
        return redirect(route('create-member'));
    }

    public function render()
    {
        $this->members = $this->readyToLoad ? $this->getMembers() : collect([]);

        return view('livewire.members', [
            'version' => Version::version('members'),
        ])
            ->layout('layouts.app', [
                'header' => null,
            ]);
    }
}
