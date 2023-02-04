<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
class MemberComponet extends Component
{

    use WithPagination;
    public $searchText = "";
    public $pageNumber;

    protected $listeners = ['openStatus'=>'openStatus', 'closeStatus'=>'closeStatus'];

    public function mount(){
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
        if(Auth::user()->highest_auth){
            $downs = User::where([['utype', 'USR'], ['username', 'like', "%$this->searchText%"]])->paginate($this->pageNumber);
        }else{
            $downs = User::where([['toponline', Auth::user()->id], ['utype', 'USR'], ['username', 'like', "%$this->searchText%"]])->paginate($this->pageNumber);
        }

        return view('livewire.member-componet', ['downs'=>$downs])->layout('layouts.base');
    }
}
