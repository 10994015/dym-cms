<?php

namespace App\Http\Livewire;

use App\Models\BetList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReportManage extends Component
{
    public $startTime;
    public $endTime;
    public $betList = [];
    public $total_bet;
    public function mount(){
        $this->startTime = date('Y-m-d');
        $this->endTime = date('Y-m-d', strtotime("+1 day"));
    }
    public function render()
    {
        if(Auth::user()->highest_auth === 1){
            $this->betList = BetList::whereBetween('created_at', [$this->startTime,   $this->endTime])->get();
            $this->total_bet = BetList::whereBetween('created_at', [$this->startTime,   $this->endTime])->count();
        }else{
            $collection = BetList::whereBetween('created_at', [$this->startTime,   $this->endTime])->get();
            $this->betList = $collection->filter(function ($e) {
                
                return User::find($e->user_id)->toponline === Auth::id();
            });
            $this->total_bet = count($this->betList);
        }
        return view('livewire.report-manage')->layout('layouts.base');
    }
}
