<?php

namespace App\Http\Livewire;

use App\Models\BetList;
use App\Models\Subaccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
class GameManage extends Component
{
    use WithPagination;
    public $startTime;
    public $endTime;

    public $startMoney;
    public $endMoney;

    public $betNumber;
    public $account;
    public $game_type;
    // public $betList = [];
    public $count_bet;
    public $total_bet_money;
    public $total_win_money;
    public $pageNumber;
    public function mount(){

        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->bet_record !== 1){
                return redirect('/');
            }
        }

        $this->pageNumber = 50;
        $this->startMoney = 0;
        $this->endMoney = 10000000;
        $this->startTime = date('Y-m-d');
        $this->endTime = date('Y-m-d', strtotime("+1 day"));
    }
    public function render()
    {
        if(Auth::user()->highest_auth === 1 || Auth::user()->issub){
            $betList = BetList::join('users', 'betlist.user_id','=', 'users.id')
            ->select('users.username', 'betlist.*')
            ->where([['betlist.bet_number', 'like', '%'.$this->betNumber.'%'], ['users.username', 'like', '%'. $this->account .'%'], ['betlist.game_type', 'like', '%'.$this->game_type.'%']])
            ->whereBetween('betlist.money', [$this->startMoney,   $this->endMoney])
            ->whereBetween('betlist.created_at', [$this->startTime,   $this->endTime])
            ->paginate($this->pageNumber);
        }else{
            $betList = BetList::join('users', 'betlist.user_id','=', 'users.id')
            ->select('users.username', 'betlist.*')
            ->where([['topline', Auth::id()], ['betlist.bet_number', 'like', '%'.$this->betNumber.'%'], ['users.username', 'like', '%'. $this->account .'%'], ['betlist.game_type', 'like', '%'.$this->game_type.'%']])
            ->whereBetween('betlist.money', [$this->startMoney,   $this->endMoney])
            ->whereBetween('betlist.created_at', [$this->startTime,   $this->endTime])
            ->paginate($this->pageNumber);
        }


        // if(Auth::user()->highest_auth !== 1){
        //     $betList = $betList->filter(function ($e) {
        //         return User::find($e->user_id)->toponline === Auth::id();
        //     });
        // }
        return view('livewire.game-manage', ['betList'=>$betList])->layout('layouts.base');
    }
}
