<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class HomeComponet extends Component
{
    public $searchText;
    protected $listeners = ['viewDownline' => 'viewDownline', 'openStatus'=>'openStatus', 'closeStatus'=>'closeStatus'];
    

    public function openStatus($id){
        $user = User::find($id);
        $user->status = 1;
        $user->save();
    }
    public function closeStatus($id){
        $user = User::find($id);
        $user->status = 0;
        $user->save();
    }
    public function viewDownline($id){
        Log::info($id);
        $data = [];
        if(User::find($id)->highest_auth === 1){
            $users = User::where([['utype', 'ADM'],['id', '<>', $id]])->get();
            $users_total = User::where([['utype', 'ADM'], ['id', '<>', $id]])->count();
        }else{
            $users = User::where([['toponline', $id], ['utype', 'ADM']])->get();
            $users_total = User::where([['toponline', $id], ['utype', 'ADM']])->count();
        }
        
        if ($users_total == 0){
            return;
        }
        foreach($users as $key=>$user){
            array_push($data, []);
            $data[$key]['id'] = $user->id;
            $data[$key]['sub'] = "DYM";
            $data[$key]['level'] = "代理";
            $data[$key]['username'] = $user->username;
            $data[$key]['name'] = $user->name;
            $data[$key]['downline'] = User::where([['toponline', $user->id], ['utype', 'ADM']])->count();              
            $data[$key]['member_num'] =User::where([['toponline',  $user->id], ['utype', 'USR']])->count();  
            $data[$key]['status'] = $user->status;
            $data[$key]['last_login_date'] = $user->last_login_time;
            $data[$key]['dividends'] = "無權限";
            $data[$key]['register_date'] =  $user->created_at->format("Y-m-d H:i:s");
            log::info($user->created_at);
        }
        $this->dispatchBrowserEvent('viewDownlineFn', ['data'=>$data]);
    }
    public function searchFn(){
        $data = [];
        if(Auth::user()->highest_auth == 1){
            $searchUsers = User::where([['utype', 'ADM'], ['username', 'like', '%'.$this->searchText.'%']])->get();
            $searchUsersCount = User::where([['utype', 'ADM'], ['username', 'like', '%'.$this->searchText.'%']])->count();
        }else{
            $searchUsers = User::where([['toponline', Auth::user()->id], ['utype', 'ADM'], ['username', 'like', '%'.$this->searchText.'%']])->get();
            $searchUsersCount = User::where([['toponline', Auth::user()->id], ['utype', 'ADM'], ['username', 'like', '%'.$this->searchText.'%']])->count();
        }
        if ($searchUsersCount == 0){
            return;
        }
        foreach($searchUsers as $key=>$user){
            array_push($data, []);
            $data[$key]['id'] = $user->id;
            $data[$key]['sub'] = "DYM";
            $data[$key]['level'] = "代理";
            $data[$key]['username'] = $user->username;
            $data[$key]['name'] = $user->name;
            $data[$key]['downline'] = User::where([['toponline', $user->id], ['utype', 'ADM']])->count();              
            $data[$key]['member_num'] =User::where([['toponline',  $user->id], ['utype', 'USR']])->count();  
            $data[$key]['status'] = $user->status;
            $data[$key]['last_login_date'] = $user->last_login_time;
            $data[$key]['dividends'] = "無權限";
            $data[$key]['register_date'] =  $user->created_at->format("Y-m-d H:i:s");
            log::info($user->created_at);
        }
        log::info($data);
        $this->dispatchBrowserEvent('searchUsersFn', ['data'=>$data]);
    }
    public function render()
    {
        // $users = User::where('')

        $downlineNum = User::where([['toponline', Auth::user()->id], ['utype', 'ADM']])->count();
        $memberNum= User::where([['toponline', Auth::user()->id], ['utype', 'USR']])->count();

        $me = [
            "id"=>"",
            "sub"=>"DYM",
            "level"=>"",
            "username"=>"",
            "name"=>"",
            "downline"=>"",
            "member_num"=>"",
            "status"=>"",
            "last_login_date"=>"",
            "dividends"=>"",
            "register_date"=>"",
        ];
        // Log::info(Auth::user());
        $me['id'] = Auth::user()->id;
        $me['level'] = Auth::user()->utype==="ADM" ? "代理" : "會員";
        $me['username'] = Auth::user()->username;
        $me['name'] = Auth::user()->name;
        $me['downline'] = $downlineNum;
        $me['member_num'] = $memberNum;
        $me['status'] = Auth::user()->status;
        $me['last_login_date'] = Auth::user()->last_login_time;
        $me['dividends'] = "無權限";
        $me['register_date'] = Auth::user()->created_at;

      
        return view('livewire.home-componet', ['me'=>$me])->layout('layouts.base');
    }
}
