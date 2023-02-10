<?php

namespace App\Http\Livewire;

use App\Models\Subaccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateMember extends Component
{
    public function mount(){
        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->member !== 1){
                return redirect('/');
            }
        }
    }
    public function render()
    {
        return view('livewire.create-member')->layout('layouts.base');
    }
}
