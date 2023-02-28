<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subaccount;
class Dashborad extends Component
{
    use WithPagination;
    public $dateArr = [];
    public $register_number = [];
    public $today;
    public $total;
    public function mount(){
        for($i=0;$i<10;$i++){
            $num = User::whereBetween('created_at', [(new Carbon())->subDays($i)->startOfDay()->toDateString(), (new Carbon())->subDays($i - 1)->startOfDay()->toDateString()])->where('utype', 'USR')->count();
            array_push($this->dateArr, date("Y-m-d",strtotime("-$i day")));
            array_push($this->register_number, $num);
        }
        $this->dateArr = array_reverse($this->dateArr);
        $this->register_number = array_reverse($this->register_number);

        $this->today = User::whereBetween('created_at', [(new Carbon())->subDays(0)->startOfDay()->toDateString(), (new Carbon())->subDays(-1)->startOfDay()->toDateString()])->where('utype', 'USR')->count();
        $this->total = User::where('utype', 'USR')->count();
    }
    public function hydrate(){
    }
    public function render()
    {
        $withdraw = Withdraw::orderBy("created_at", "DESC")->paginate(10);
        return view('livewire.dashborad', ['dateArr'=>$this->dateArr, 'register_number'=>$this->register_number, 'withdraw'=>$withdraw])->layout('layouts.base');
    }
}
