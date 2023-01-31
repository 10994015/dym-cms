<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateMember extends Component
{
    public function render()
    {
        return view('livewire.create-member')->layout('layouts.base');
    }
}
