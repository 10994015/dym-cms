<?php

namespace App\Http\Livewire;

use App\Models\Subaccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangeProxyPassword extends Component
{
    public $proxy_id;
    public $username;
    public function mount($id){
        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->proxy !== 1){
                return redirect('/');
            }
        }

        if (User::find($id)->utype !== "ADM") redirect('/notfound'); 
        if(Auth::user()->highest_auth != 1){
            if(User::find($id)->toponline != Auth::id()) return redirect('/notfound');
        }
        $this->proxy_id = $id;

        $this->username = User::find($id)->username;
    }
    public function render()
    {
        return view('livewire.change-proxy-password')->layout('layouts.base');
    }
}
