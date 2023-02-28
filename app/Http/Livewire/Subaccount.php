<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Subaccount extends Component
{
    use WithPagination;
    public $pageNumber;
    protected $listeners = ['openStatus'=>'openStatus', 'closeStatus'=>'closeStatus'];

    public function mount(){
        if(Auth::user()->highest_auth !== 1){
            return redirect('/notfound');
        }
        $this->pageNumber = 15;
    }
    public function openStatus($id){
        $user = User::find($id);
        $user->status = 1;
        $user->save();
    }
    public function closeStatus($id){
        $user = User::find($id);
        $user->status = 0;
        $user->save();
    }
    public function render()
    {
        $users = User::where([['utype', 'ADM'], ['issub', 1]])->paginate($this->pageNumber);
        return view('livewire.subaccount', ['users'=>$users])->layout('layouts.base');
    }
}
