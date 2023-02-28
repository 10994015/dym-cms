<?php

namespace App\Http\Livewire;

use App\Models\BetList;
use App\Models\StorePointRecord;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class WithdrawInfo extends Component
{
    public $withdrawId;
    public $user_id;
    public $username;
    public $platform;
    public $order_number;
    public $money;
    public $currency;
    public $status;
    public $warning;
    public $comment;
    public $gapMoney;
    public $created_at;
    public $betweenBet;
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
        $this->username = User::find($this->user_id)->username;

        $with = Withdraw::where([['user_id', $this->user_id], ['status', 1], ['paidout', 1]])->orderBy('updated_at')->first();;
        if($with != null){
            $lastPayoutTime = $with->updated_at;
        }else{
            $lastPayoutTime = date("Y-m-d H:i:s", strtotime("1970-01-01 00:00:00"));
        }
       

        $this->betweenBet = BetList::where([['user_id', $this->user_id], ['bet_time', '>', $lastPayoutTime], ['bet_time', '<=', $this->created_at]])->sum('money');
     

    }
    public function updateWithdraw(){
        $withdraw = Withdraw::find($this->withdrawId);
        $withdraw->user_id =   $this->user_id;
        $withdraw->platform =   $this->platform;
        $withdraw->order_number =   $this->order_number;
        $withdraw->money =   $this->money;
        $withdraw->status =    intval($this->status);
        $withdraw->comment =    $this->comment;
        $withdraw->proxy_id = Auth::id();

        if($withdraw->status < 0){
            if(!$withdraw->returned){
                $withdraw->returned = true;
                $user = User::find($this->user_id);
                $user->money = $user->money + $this->money;
                $user->handle_money = $user->handle_money - $this->money;
                $withdraw->warning = "提領失敗，已退款 $" . strval($this->money);
                $user->save();

            }
        }elseif($withdraw->status > 0){
            if(!$withdraw->paidout){
                $withdraw->paidout = true;
                $user = User::find($this->user_id);
                $user->handle_money = $user->handle_money - $this->money;
                $withdraw->warning = "提領成功，已出款 $" . strval($this->money);
                $user->save();
            }
        }

        $withdraw->save();

        session()->flash('success', '更新成功！');
    }
    public function render()
    {
        return view('livewire.withdraw-info')->layout('layouts.base');
    }
}
