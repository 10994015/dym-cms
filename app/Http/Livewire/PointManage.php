<?php

namespace App\Http\Livewire;

use App\Models\Subaccount;
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

        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->store !== 1){
                return redirect('/');
            }
        }
        
        $this->pageNumber = 15;
    }
    public function render()
    {


        if(Auth::user()->highest_auth || Auth::user()->issub){
            $users = User::where([['utype', 'USR'], ['username', 'like', '%'.$this->searchText.'%']])->orderBy('created_at', 'DESC')->paginate($this->pageNumber);
        }else{
            $users = User::where([['utype', 'USR'], ['toponline', Auth::user()->id], ['username', 'like', '%'.$this->searchText.'%']])->orderBy('created_at', 'DESC')->paginate($this->pageNumber);
        }

        return view('livewire.point-manage', ['users'=>$users])->layout('layouts.base');
    }
}
