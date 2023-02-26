<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetSubaccount extends Component
{
    public $sub_id;
    public $substation;
    public $url;
    public $username;
    public $name;
    public $topline;
    public $register_number;
    public $topline_name;
    protected $listeners = ['deleteSubaccount' => 'deleteSubaccount']; 
    public function mount($id){
        if(Auth::user()->highest_auth !== 1){
            return redirect('/notfound');
        }
        $this->sub_id = $id;
        $this->substation = "SMT";

        $user = User::find($id);
        if($user->utype !== "ADM" || $user->issub !== 1) return redirect('/notfound');

        $this->username = $user->username;
        $this->name = $user->name;
        $this->url = "http://127.0.0.1:8000/register?rn=" . $user->register_number;
        $this->topline = $user->toponline;
        $this->topline_name = User::find($this->topline)->username;

    }
    public function deleteSubaccount(){
        if(User::find($this->sub_id)->issub !== 1){
            $this->dispatchBrowserEvent('deleteFailFn');
        }
        User::where('id', $this->sub_id)->delete();
        User::where('toponline', $this->sub_id)->update([
            'toponline' => User::where('highest_auth', 1)->first()->id,
        ]);
        $this->dispatchBrowserEvent('deleteSuccessFn');
    }
    public function render()
    {
        return view('livewire.set-subaccount')->layout('layouts.base');
    }
}
