<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateMember extends Component
{
    public function toDashboard()
    {
        return redirect()->to(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.create-member')
            ->layout('layouts.app', [
                'header' => null,
            ]);
    }
}
