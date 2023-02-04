<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
class PointManage extends Component
{
    use WithPagination;
    public $pageNumber;
    public $searchText = "";
    public function mount(){
        $this->pageNumber = 15;
    }
    public function render()
    {


        if(Auth::user()->highest_auth){
            $users = User::where([['utype', 'USR'], ['username', 'like', '%'.$this->searchText.'%']])->paginate($this->pageNumber);
        }else{
            $users = User::where([['utype', 'USR'], ['toponline', Auth::user()->id], ['username', 'like', '%'.$this->searchText.'%']])->paginate($this->pageNumber);
        }

        return view('livewire.point-manage', ['users'=>$users])->layout('layouts.base');
    }
}
