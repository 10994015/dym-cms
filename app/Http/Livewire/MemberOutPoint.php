<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subaccount;

class MemberOutPoint extends Component
{
    use WithPagination;

    public $pageNumber;
    public $searchText;

    public function mount(){
        $this->pageNumber = 30;
    }
    public function render()
    {
        $users = User::where([['utype', 'USR'], ['username', 'like', '%'.$this->searchText.'%']])->paginate($this->pageNumber);
        return view('livewire.member-out-point', ['users'=>$users])->layout('layouts.base');
    }
}
