<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Proxy extends Component
{
    public $users;
    public $account;
    public $name;
    public $phone;
    public $money;
    public $url;
    public $topline;
    public $update_user_id;
    public $searchText;
    public function mount(){
        $this->update_user_id = Auth::user()->id;
        $this->account = Auth::user()->username;
        $this->name = Auth::user()->name;
        $this->phone = Auth::user()->phone;
        $this->money = Auth::user()->money;
        $this->url = "http://dymgame-env.eba-eay7gtmu.ap-southeast-1.elasticbeanstalk.com/register?rn=" . Auth::user()->register_number;
        if(Auth::user()->toponline == NULL){
            $this->topline = "無";
        }else{
            $this->topline = User::find(Auth::user()->toponline)->username;
        }
    }
    public function viewUserInfo($id){
        $this->update_user_id = $id;
        Log::info($this->id);
        $user = User::find($id);
        $this->account = $user->username;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->money = $user->money;
        if(User::find($id)->utype==="ADM"){
            $this->url = "http://dymgame-env.eba-eay7gtmu.ap-southeast-1.elasticbeanstalk.com/register?rn=" . $user->register_number;
        }else{
            $this->url = "無";
        }
        if(User::find($id)->toponline == NULL){
            $this->topline = "無";
        }else{
            $this->topline = User::find(User::find($id)->toponline)->username;
        }
        $this->dispatchBrowserEvent('viewUserInfo');
    }
    public function searchFn(){
        if($this->searchText != ""){
            return redirect('proxy/?s=' . $this->searchText);
        }else{
            return redirect('/');
        }
        
    }
    public function updateUserInfo(){
        $user = User::find($this->update_user_id);
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->money = $this->money;
        $user->save();
    }
    public function memberManageFn(){
        return redirect('/');
    }
    public function proxyManageFn(){
        return redirect('/proxy');
    }
    public function render()
    {
        $s = '';
        if(isset(request()->s)){
            $s = request()->s;
        }
        if(Auth::user()->username === "admin"){
            $this->users = User::where([['utype', 'ADM'], ['username', '<>', 'admin'],['username', 'like', "%$s%"]])->get();
        }else{
            $this->users = User::where([['toponline', Auth::id()], ['utype', 'ADM'], ['username', 'like', "%$s%"]])->get();            
        }
        $this->dispatchBrowserEvent('changeQRcode', ['url'=>$this->url]);
        return view('livewire.home', ['users'=>$this->users])->layout('layouts.base');
    }
}