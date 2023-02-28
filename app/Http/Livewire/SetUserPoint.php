<?php

namespace App\Http\Livewire;

use App\Models\StorePointRecord;
use App\Models\Subaccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetUserPoint extends Component
{
    public $member_id;
    public $username;
    public $name;
    public $store;
    public $store_type;
    public $point;
    public $money;
    public function mount($id){

        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->store !== 1){
                return redirect('/');
            }
        }
        if (User::find($id)->utype !== "USR") redirect('/notfound'); 
        if(Auth::user()->highest_auth != 1){
            if(User::find($id)->toponline != Auth::id()) return redirect('/notfound');
        }

        $this->member_id = $id;
        $user = User::find($id);
        $this->username = $user->username;
        $this->name = $user->name;
        $this->money = $user->money;
        $this->store = 1;
        $this->store_type = 1;
        $this->point = 0;
    }

    public function storePoint(){
        if($this->point <=0){
            session()->flash('error', '上分金額須超過0');
            return;
        }
        
        $user = User::find($this->member_id);
        if($this->store == 1){
            $user->money = $user->money + $this->point;
            if($this->store_type==1 || $this->store_type == 2){
                $user->total_money = $user->total_money + $this->point;
            }
            $user->save();
        }elseif($this->store == -1){
            $user->money = $user->money - $this->point;
            $user->save();
        }

        $store_point_record = new StorePointRecord();
        $store_point_record->money = $this->point;
        $store_point_record->store = $this->store;
        $store_point_record->store_type = $this->store_type;
        $store_point_record->proxy_id = Auth::user()->id;
        $store_point_record->member_id = $this->member_id;
        $store_point_record->save();

        $this->dispatchBrowserEvent('storeSuccessFn');
    }
    public function render()
    {
        return view('livewire.set-user-point')->layout('layouts.base');
    }
}
