<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SetMember extends Component
{

    public $member_id;
    public function mount($id){
        $this->member_id = $id;
    }
    public function render()
    {
        return view('livewire.set-member')->layout('layouts.base');
    }
}
