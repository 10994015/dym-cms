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
    public function mount(){
        if(Auth::user()->highest_auth !== 1){
            return redirect('/notfound');
        }
        $this->pageNumber = 15;
    }
    public function render()
    {
        $users = User::where([['utype', 'ADM'], ['issub', 1]])->paginate($this->pageNumber);
        return view('livewire.subaccount', ['users'=>$users])->layout('layouts.base');
    }
}
