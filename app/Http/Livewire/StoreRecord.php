<?php

namespace App\Http\Livewire;

use App\Models\StorePointRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StoreRecord extends Component
{
    public $member_id;
    public function mount($id){
        if (User::find($id)->utype !== "USR") redirect('/notfound'); 
        if(Auth::user()->highest_auth != 1){
            if(User::find($id)->toponline != Auth::id()) return redirect('/notfound');
        }
        $this->member_id = $id;
    }
    public function render()
    {
        $list = StorePointRecord::where('member_id', $this->member_id)->get();
        return view('livewire.store-record', ['list'=>$list])->layout('layouts.base');
    }
}