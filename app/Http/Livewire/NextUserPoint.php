<?php

namespace App\Http\Livewire;

use App\Models\StorePointRecord;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NextUserPoint extends Component
{
    public $member_id;
    public $username;
    public $name;
    public $store;
    public $store_type;
    public $point;
    public $money;
    public function mount($id){

        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->store !== 1){
                return redirect('/');
            }
        }

        if (User::find($id)->utype !== "USR") redirect('/notfound'); 
        if(Auth::user()->highest_auth != 1){
            if(User::find($id)->toponline != Auth::id()) return redirect('/notfound');
        }

        $this->member_id = $id;
        $user = User::find($id);
        $this->username = $user->username;
        $this->name = $user->name;
        $this->money = $user->money;
        $this->store = -1;
        $this->store_type = 1;
        $this->point = 0;
    }

    public function storePoint(){
        $user = User::find($this->member_id);
        if($this->point <= 0){
            session()->flash('error', '交易失敗！下分金額需大於0');
            return;
        }
        if($this->point > $this->money){
            session()->flash('error', '交易失敗！會員餘額不足！');
            return;
        }
        $rand = rand(10000, 99999);
        $order_number = "SA" . $rand . date('YmdHi');
        $withdraw = new Withdraw();
        $withdraw->user_id = $user->id;
        $withdraw->username = $user->username;
        $withdraw->platform = "SMT";
        $withdraw->order_number = $order_number;
        $withdraw->money = $this->point;
        $withdraw->status = 1;
        $withdraw->store_type = $this->store_type;
        $withdraw->proxy_id = Auth::id();
        $withdraw->paidout = 1;
        $withdraw->save();
        $this->dispatchBrowserEvent('storeSuccessFn');
    }
    public function render()
    {
        return view('livewire.next-user-point')->layout('layouts.base');
    }
}
