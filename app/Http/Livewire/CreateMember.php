<?php

namespace App\Http\Livewire;

use App\Models\Subaccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateMember extends Component
{
    public $toplines = [];
    public function mount(){
        if(!Auth::user()->is_create_member){
            return redirect('/notfound');
        }

        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->member !== 1){
                return redirect('/');
            }
        }
        if(Auth::user()->highest_auth === 1){
            $toplines = User::where([['utype', 'ADM'], ['id', '<>', Auth::id()]])->get();
            $this->toplines = $toplines;
        }else{
            $toplines = User::where([['utype', 'ADM'], ['toponline', Auth::id()]])->get();
            $this->toplines = $toplines;
        }
        
    }
    public function render()
    {
        return view('livewire.create-member')->layout('layouts.base');
    }
}
