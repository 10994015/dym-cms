<?php

namespace App\Http\Livewire;

use App\Models\Subaccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangeMemberPassword extends Component
{
    public $member_id;
    public $username;
    public function mount($id){

        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->member !== 1){
                return redirect('/');
            }
        }

        if (User::find($id)->utype !== "USR") redirect('/notfound'); 
        if(Auth::user()->highest_auth != 1){
            if(User::find($id)->toponline != Auth::id()) return redirect('/notfound');
        }
        $this->member_id = $id;

        $this->username = User::find($id)->username;
    }
    public function render()
    {
        return view('livewire.change-member-password')->layout('layouts.base');
    }
}
