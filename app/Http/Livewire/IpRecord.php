<?php

namespace App\Http\Livewire;

use App\Models\LoginRecord;
use App\Models\Subaccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IpRecord extends Component
{
    public $ip;
    public function mount($ip){
        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->member !== 1){
                return redirect('/');
            }
        }
        $this->ip = $ip;
    }
    public function render()
    {
        $list = LoginRecord::where('login_ip', $this->ip)->get();
        return view('livewire.ip-record', ['list'=>$list])->layout('layouts.base');
    }
}
