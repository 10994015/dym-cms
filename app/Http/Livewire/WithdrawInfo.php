<?php

namespace App\Http\Livewire;

use App\Models\BetList;
use App\Models\StorePointRecord;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class WithdrawInfo extends Component
{
    public $withdrawId;
    public $user_id;
    public $platform;
    public $order_number;
    public $money;
    public $currency;
    public $status;
    public $warning;
    public $comment;
    public $gapMoney;
    public $created_at;
    public $totalBet;
    public function mount($id){
        if(Auth::user()->highest_auth !=1){
            return redirect('/notfound');
        }
        $this->withdrawId = $id;
        $withdraw = Withdraw::find($id);
        $this->user_id =$withdraw->user_id ;
        $this->platform =$withdraw->platform ;
        $this->order_number =$withdraw->order_number ;
        $this->money =$withdraw->money ;
        $this->status =$withdraw->status ;
        $this->warning =$withdraw->warning ;
        $this->comment =$withdraw->comment ;
        $this->currency = '-';
        $this->created_at = $withdraw->created_at;

        $storePoinr = StorePointRecord::where([['member_id', $this->user_id], ['store', 1], ['store_type', '<=', 3], ['created_at' ,'<=', $this->created_at]])->orderBy('created_at', 'DESC')->first();
        $initialDate = $storePoinr->created_at; //最近一次儲值時間

        $this->totalBet = BetList::where([['user_id', $this->user_id], ['created_at', '>=',$initialDate]])->sum('money');

    }
    public function updateWithdraw(){
        $withdraw = Withdraw::find($this->withdrawId);
        $withdraw->user_id =   $this->user_id;
        $withdraw->platform =   $this->platform;
        $withdraw->order_number =   $this->order_number;
        $withdraw->money =   $this->money;
        $withdraw->status =    intval($this->status);
        $withdraw->warning =    $this->warning; 
        $withdraw->comment =    $this->comment;

        $withdraw->save();

        session()->flash('success', '更新成功！');
    }
    public function render()
    {
        return view('livewire.withdraw-info')->layout('layouts.base');
    }
}
