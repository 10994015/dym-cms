<?php

namespace App\Http\Livewire;

use App\Models\BetList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ReportManage extends Component
{
    use WithPagination;
    public $startTime;
    public $endTime;
    public $startMoney;
    public $endMoney;

    public $betNumber;
    public $account;
    public $game_type;
    public $count_bet;
    public $total_bet_money;
    public $total_win_money;
    public $pageNumber;
    public function mount(){
        $this->pageNumber = 50;
        $this->startMoney = 0;
        $this->endMoney = 10000000;
        $this->startTime = date('Y-m-d');
        $this->endTime = date('Y-m-d', strtotime("+1 day"));
    }
    public function render()
    {
        $betList = BetList::join('users', 'betlist.user_id','=', 'users.id')
        ->select('users.username', 'betlist.*')
        ->where([['betlist.bet_number', 'like', '%'.$this->betNumber.'%'], ['users.username', 'like', '%'. $this->account .'%'], ['betlist.game_type', 'like', '%'.$this->game_type.'%']])
        ->whereBetween('betlist.money', [$this->startMoney,   $this->endMoney])
        ->whereBetween('betlist.created_at', [$this->startTime,   $this->endTime])
        ->paginate($this->pageNumber);
        if(Auth::user()->highest_auth !== 1){
            $betList = $betList->filter(function ($e) {
                return User::find($e->user_id)->toponline === Auth::id();
            });
        }
        $this->total_bet_money = $betList->sum('money');
        $this->total_win_money = $betList->sum('result');

        // if(Auth::user()->highest_auth === 1){
        //     $betList = BetList::whereBetween('created_at', [$this->startTime,   $this->endTime])->paginate($this->pageNumber);
        //     $this->count_bet = BetList::whereBetween('created_at', [$this->startTime,   $this->endTime])->count();
           
        // }else{
        //     $collection = BetList::whereBetween('created_at', [$this->startTime,   $this->endTime])->paginate($this->pageNumber);
        //     $betList = $collection->filter(function ($e) {
        //         return User::find($e->user_id)->toponline === Auth::id();
        //     });
        //     $this->count_bet = count($betList);
        //     $this->total_bet_money = $betList->sum('money');
        //     $this->total_win_money = $betList->sum('result');
        // }
        return view('livewire.report-manage', ['betList'=>$betList])->layout('layouts.base');
    }
}
