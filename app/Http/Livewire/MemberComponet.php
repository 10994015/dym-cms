<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MemberComponet extends Component
{
    public function render()
    {

        $downs = User::where([['toponline', Auth::user()->id], ['utype', 'USR']])->get();


        $downlineNum = User::where([['toponline', Auth::user()->id], ['utype', 'ADM']])->count();
        $memberNum= User::where([['toponline', Auth::user()->id], ['utype', 'USR']])->count();

        $me = [
            "id"=>"",
            "sub"=>"DYM",
            "topline"=>"",
            "username"=>"",
            "name"=>"",
            "money"=>"",
            "total_money"=>"",
            "game_money"=>"",
            "phone"=>"",
            "last_login_date"=>"",
            "last_login_ip"=>"",
            "recommender"=>"",
            "status"=>"",
            "register_date"=>"",
        ];
        // Log::info(Auth::user());
        Log::info(Auth::user()->toponline);
        $me['id'] = Auth::user()->id;
        $me['topline'] = Auth::user()->toponline==NULL ? "" : User::where('id', Auth::user()->toponline)->first()->name;
        $me['username'] = Auth::user()->username;
        $me['name'] = Auth::user()->name;
        $me['money'] = Auth::user()->money;
        $me['total_money'] = 0;
        $me['game_money'] = "-";
        $me['phone'] = Auth::user()->phone;
        $me['last_login_date'] = Auth::user()->last_login_time;
        $me['last_login_ip'] = Auth::user()->last_login_ip;
        $me['status'] = Auth::user()->status;
        $me['register_date'] = Auth::user()->created_at;

     

        return view('livewire.member-componet', ['me'=>$me, 'downs'=>$downs])->layout('layouts.base');
    }
}
