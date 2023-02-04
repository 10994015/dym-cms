<?php

namespace App\Http\Livewire;

use App\Models\LoginRecord as ModelsLoginRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginRecord extends Component
{
    public $username;
    public function mount($id){
        if (User::find($id)->utype !== "USR") redirect('/notfound'); 
        if(Auth::user()->highest_auth != 1){
            if(User::find($id)->toponline != Auth::id()) return redirect('/notfound');
        }
        $this->username = User::find($id)->username;
    }
    public function render()
    {
        $list = ModelsLoginRecord::where('username', $this->username)->get();
        return view('livewire.login-record', ['list'=>$list])->layout('layouts.base');
    }
}
