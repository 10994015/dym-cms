<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Subaccount;


class ViewSubMember extends Component
{  
    public $sub_id;
    public function mount($id){
        if(Auth::user()->highest_auth !== 1 || User::find($id)->issub !== 1) return redirect('/notfound');
        
        $this->sub_id = $id;
    }
    public function render()
    {
        $users = User::where([['utype', 'ADM'], ['toponline', $this->sub_id]])->get();
        return view('livewire.view-sub-member', ['users'=>$users])->layout('layouts.base');
    }
}
