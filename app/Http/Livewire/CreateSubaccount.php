<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateSubaccount extends Component
{
    public function mount(){
        if(Auth::user()->highest_auth !== 1){
            return redirect('/notfound');
        }
    }
    public function render()
    {
        return view('livewire.create-subaccount')->layout('layouts.base');
    }
}
