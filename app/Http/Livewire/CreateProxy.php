<?php

namespace App\Http\Livewire;

use App\Models\Subaccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateProxy extends Component
{
    public $account;
    public $name;
    public $phone;
    public $password;
    public $r_number;
    public function mount($id){
        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->proxy !== 1){
                return redirect('/');
            }
        }


        if (User::find($id)->utype !== "ADM") redirect('/notfound'); 
        if(Auth::user()->highest_auth != 1){
            if(Auth::id() != $id){
                if(User::find($id)->toponline != Auth::id()) return redirect('/notfound');
            }
        }
    }
    public function render()
    {
        return view('livewire.create-proxy')->layout('layouts.base');
    }
}
