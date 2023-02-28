<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subaccount;
class CreateSubProxy extends Component
{
    public function render()
    {
        return view('livewire.create-sub-proxy')->layout('layouts.base');
    }
}
