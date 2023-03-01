<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subaccount;


class NextPointManage extends Component
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
            $withdraws = Withdraw::where([['status', 1], ['paidout', 1],['username', 'like', "%$this->searchText%"]])->orderBy('updated_at', 'DESC')->paginate($this->pageNumber);
            // $users = User::where([['utype', 'USR'], ['username', 'like', '%'.$this->searchText.'%']])->paginate($this->pageNumber);
        }else{
            $withdraws = Withdraw::where([['status', 1], ['paidout', 1],['proxy_id', Auth::id()], ['username', 'like', "%$this->searchText%"]])->orderBy('updated_at', 'DESC')->paginate($this->pageNumber);
        }
        return view('livewire.next-point-manage', ['withdraws'=>$withdraws])->layout('layouts.base');
    }
}
