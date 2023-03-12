<?php

namespace App\Http\Livewire;

use App\Models\BetList;
use App\Models\Report;
use App\Models\Subaccount;
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
        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->report !== 1){
                return redirect('/');
            }
        }

        $this->pageNumber = 50;
        $this->startMoney = 0;
        $this->endMoney = 10000000;
        $this->startTime = date('Y-m-d');
        $this->endTime = date('Y-m-d', strtotime("+2 day"));
    }
    public function render()
    {
       
        if(Auth::user()->highest_auth === 1 || Auth::user()->issub){
            $reports = Report::join('users', 'reports.user_id','=', 'users.id')
            ->select('users.username', 'reports.*')
            ->where([['reports.bet_number', 'like', '%'.$this->betNumber.'%'], ['users.username', 'like', '%'. $this->account .'%'], ['reports.game_type', 'like', '%'.$this->game_type.'%']])
            ->whereBetween('reports.bet_money', [$this->startMoney,   $this->endMoney])
            ->whereBetween('reports.created_at', [$this->startTime,   $this->endTime])
            ->orderBy('id', 'DESC')
            ->paginate($this->pageNumber);

            $reports_total = Report::join('users', 'reports.user_id','=', 'users.id')
            ->select('users.username', 'reports.*')
            ->where([['reports.bet_number', 'like', '%'.$this->betNumber.'%'], ['users.username', 'like', '%'. $this->account .'%'], ['reports.game_type', 'like', '%'.$this->game_type.'%']])
            ->whereBetween('reports.bet_money', [$this->startMoney,   $this->endMoney])
            ->whereBetween('reports.created_at', [$this->startTime,   $this->endTime])
            ->orderBy('id', 'DESC')
            ->get();
        }else{
            $reports = Report::join('users', 'reports.user_id','=', 'users.id')
            ->select('users.username', 'reports.*')
            ->where([['topline', Auth::id()], ['reports.bet_number', 'like', '%'.$this->betNumber.'%'], ['users.username', 'like', '%'. $this->account .'%'], ['reports.game_type', 'like', '%'.$this->game_type.'%']])
            ->whereBetween('reports.bet_money', [$this->startMoney,   $this->endMoney])
            ->whereBetween('reports.created_at', [$this->startTime,   $this->endTime])
            ->orderBy('id', 'DESC')
            ->paginate($this->pageNumber);

            $reports_total = Report::join('users', 'reports.user_id','=', 'users.id')
            ->select('users.username', 'reports.*')
            ->where([['topline', Auth::id()], ['reports.bet_number', 'like', '%'.$this->betNumber.'%'], ['users.username', 'like', '%'. $this->account .'%'], ['reports.game_type', 'like', '%'.$this->game_type.'%']])
            ->whereBetween('reports.bet_money', [$this->startMoney,   $this->endMoney])
            ->whereBetween('reports.created_at', [$this->startTime,   $this->endTime])
            ->orderBy('id', 'DESC')->get();
        }
        $this->total_bet_money = $reports_total->sum('bet_money');
        $this->total_win_money = $reports_total->sum('result') - $reports_total->sum('bet_money');

        return view('livewire.report-manage', ['reports'=>$reports])->layout('layouts.base');
    }
}
