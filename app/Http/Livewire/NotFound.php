<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subaccount;

class NotFound extends Component
{
    public function render()
    {
        return view('livewire.not-found')->layout('layouts.base');
    }
}
