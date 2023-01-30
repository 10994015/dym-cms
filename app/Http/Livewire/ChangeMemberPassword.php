<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ChangeMemberPassword extends Component
{
    public $member_id;
    public $username;
    public function mount($id){
        $this->member_id = $id;

        $this->username = User::find($id)->username;
    }
    public function render()
    {
        return view('livewire.change-member-password')->layout('layouts.base');
    }
}
