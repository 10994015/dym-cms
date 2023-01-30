<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SetMember extends Component
{

    public $member_id;
    public $substation;
    public $topline_id;
    public $topline_name;
    public $username;
    public $name;
    public $phone;
    public $phone_verification;
    public $remark;
    public $point_lock;
    public $recommender;

    public $toplines = [];


    public function mount($id){
        $this->member_id = $id;
        $this->substation = "DYM";

        $user = User::find($id);

        $this->topline_id = $user->toponline;
        $this->topline_name = User::where('id', $this->topline_id)->first()->username;
        $this->username = $user->username;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->phone_verification = $user->phone_verification ? 1 : 0;
        $this->remark = $user->remark;
        $this->point_lock = $user->point_lock;
        $this->recommender = $user->recommender;


        $toplines = User::where('utype', 'ADM')->get();
        $this->toplines = $toplines;
    }
    public function changeMemberInfo(){
        $toplineAccount = User::where('username', $this->topline_name)->first()->id;
        $this->topline_id = $toplineAccount === NULL ? 1 : $toplineAccount;

        $user = User::find($this->member_id);

        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->phone_verification = $this->phone_verification;
        $user->remark = $this->remark;
        $user->point_lock = $this->point_lock;
        $user->recommender = $this->recommender;

        $user->toponline = $this->topline_id;

        $user->save();

        $this->dispatchBrowserEvent('successFn');
    }
    public function render()
    {
        return view('livewire.set-member')->layout('layouts.base');
    }
}
