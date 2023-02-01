<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SetProxy extends Component
{
    public $proxy_id;
    public $substation;
    public $url;
    public $username;
    public $name;
    public $topline;
    public $register_number;
    public $topline_name;
    public function mount($id){
        $this->proxy_id = $id;
        $this->substation = "DYM";

        $user = User::find($id);

        $this->register_number = $user->register_number;
        $this->username = $user->username;
        $this->name = $user->name;
        $this->topline = $user->toponline;
        $this->url = 'http://127.0.0.1:8005' . '/register?rn=' . $this->register_number;

        $this->topline_name = $this->topline!=NULL ? DB::table('users')->where('id', $this->topline)->first()->username : "";
    }
    public function changeProxyInfo(){
        $user = User::find($this->proxy_id);

        $user->name = $this->name;
        $user->save();
        $this->dispatchBrowserEvent('successFn');
    }
    public function render()
    {
        return view('livewire.set-proxy')->layout('layouts.base');
    }
}
