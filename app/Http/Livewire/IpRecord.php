<?php

namespace App\Http\Livewire;

use App\Models\LoginRecord;
use Livewire\Component;

class IpRecord extends Component
{
    public $ip;
    public function mount($ip){
        $this->ip = $ip;
    }
    public function render()
    {
        $list = LoginRecord::where('login_ip', $this->ip)->get();
        return view('livewire.ip-record', ['list'=>$list])->layout('layouts.base');
    }
}
