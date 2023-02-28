<?php

namespace App\Http\Livewire;

use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subaccount;


class PaymentReview extends Component
{
    use WithPagination;
    public $pageNumber;
    public $searchText = "";
    public function mount(){
        if(Auth::user()->highest_auth != 1){
            return redirect('/notfound');
        }
        $this->pageNumber = 15;
    }
    public function render()
    {
        $withdraws = Withdraw::where('username', 'like', '%'.$this->searchText.'%')->orderBy('created_at', 'DESC')->paginate($this->pageNumber);
        return view('livewire.payment-review', ['withdraws'=>$withdraws])->layout('layouts.base');
    }
}
