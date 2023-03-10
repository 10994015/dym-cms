<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Subaccount;

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
    public $isCreateMember;
    public $sub_permissions = false;
    protected $listeners = ['deleteProxy' => 'deleteProxy'];
    public function mount($id){
        
        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->proxy !== 1){
                return redirect('/notfound');
            }
            $this->sub_permissions  = true;
        }

        if (User::find($id)->utype !== "ADM") return redirect('/notfound'); 
        if(Auth::user()->highest_auth != 1){
            if(Auth::id() != $id){
                if(User::find($id)->toponline != Auth::id()){
                    if(!$this->sub_permissions)  return redirect('/notfound');
                } 
            }
        }
        $this->proxy_id = $id;
        $this->substation = "SMT";

        $user = User::find($id);

        $this->register_number = $user->register_number;
        $this->username = $user->username;
        $this->name = $user->name;
        $this->topline = $user->toponline;
        $this->url = 'https://stvecommerceita.online' . '/register?rn=' . $this->register_number;

        $this->topline_name = $this->topline!=NULL ? DB::table('users')->where('id', $this->topline)->first()->username : "";
        $this->isCreateMember = $user->is_create_member;
    }
    public function changeProxyInfo(){
        $user = User::find($this->proxy_id);

        $user->name = $this->name;
        $user->is_create_member = $this->isCreateMember;
        $user->save();
        $this->dispatchBrowserEvent('successFn');
    }
    public function deleteProxy(){
        User::where('id', $this->proxy_id)->delete();
        User::where('toponline', $this->proxy_id)->update([
            'toponline' => User::where('highest_auth', 1)->first()->id,
        ]);
        $this->dispatchBrowserEvent('deleteSuccessFn');
    }
    public function render()
    {
        return view('livewire.set-proxy')->layout('layouts.base');
    }
}
