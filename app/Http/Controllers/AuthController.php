<?php

namespace App\Http\Controllers;

use App\Models\Subaccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Validator;
class AuthController extends Controller
{
    public function register(Request $req){
        $validator =$req->validate([
            'name' => 'required|string',
            'username'=> 'required|string|unique:users',
            'password'=>[
                'required',
                'confirmed',
                'min:8',
                'max:20'
            ]
        ]);
       
        $user = new User();

        $user->username = $req->username;
        $user->name = $req->name;
        $user->password = bcrypt($req->password);
        $user->register_number = $this->generateRandomString(30);
        $user->utype = "ADM";
        $user->toponline = $req->proxy_id;
        $user->save();
        request()->session()->flash('status', '新增代理成功!');
        return redirect('/')->withInput();
        // return back()->withInput()->back();
    }
    public function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function changePassword(Request $req){
        $data = $req->validate([
            'password'=>[
                'required',
                'confirmed',
                'min:8'
            ]
        ]);
        $user = User::find($req->member_id);
        $user->password = bcrypt($req->password);
        $user->save();


        return redirect("/setMember/$req->member_id")->withInput();
    }
    public function changeProxyPassword(Request $req){
        $data = $req->validate([
            'password'=>[
                'required',
                'confirmed',
                'min:8'
            ]
        ]);
        $user = User::find($req->proxy_id);
        $user->password = bcrypt($req->password);
        $user->save();

        if($user->issub === 1){
            return redirect("/setSubaccount/$req->proxy_id")->withInput();
        }else{
            return redirect("/setProxy/$req->proxy_id")->withInput();
        }

    }

    public function createMember(Request $req){
        $data = $req->validate([
            'name' => 'required|string',
            'username'=> 'required|string|unique:users',
            'phone'=> 'required|string|size:10|unique:users',
            'password'=>[
                'required',
                'confirmed',
                'min:8',
                'max:20'
            ]
        ]);
        // $user = User::create([
        //     'name' => $data['name'],
        //     'username' => $data['username'],
        //     'phone' => $data['phone'],
        //     'password' => bcrypt($data['password']),
        //     'toponline' => Auth::id(),
        //     'utype'=>'USR',
        //     'phone_verification'=> 1,
        // ]);
        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->phone = $data['phone'];
        $user->password = bcrypt($data['password']);
        $user->toponline = Auth::id();
        $user->utype = 'USR';
        $user->phone_verification = 1;
        $user->save();

        return redirect("/member")->withInput();
    }

    public function createSubaccount(Request $req){

        if(Auth::user()->highest_auth != 1 ){
            return redirect('/notfound');
        }

        $data = $req->validate([
            'name' => 'required|string',
            'username'=> 'required|string|unique:users',
            'password'=>[
                'required',
                'confirmed',
                'min:8',
                'max:20'
            ]
        ]);

        $user = new User();

        $user->username = $req->username;
        $user->name = $req->name;
        $user->password = bcrypt($req->password);
        $user->register_number = $this->generateRandomString(30);
        $user->utype = "ADM";
        $user->issub = true;
        $user->remark = '子帳號';
        $user->toponline = Auth::id();
        $user->save();

        $sub = new Subaccount();

        $sub->proxy = isset($req->proxy) ? 1 : 0;
        $sub->member = isset($req->member) ? 1 : 0;
        $sub->store = isset($req->store) ? 1 : 0;
        $sub->bet_record = isset($req->bet_record) ? 1 : 0;
        $sub->report = isset($req->report) ? 1 : 0;
        $sub->user_id = $user->id;

        $sub->save();

        return redirect("/subaccount")->withInput();
    }

    public function registerSubProxy(Request $req){
        $validator =$req->validate([
            'name' => 'required|string',
            'username'=> 'required|string|unique:users',
            'password'=>[
                'required',
                'confirmed',
                'min:8',
                'max:20'
            ]
        ]);
       
        $user = new User();

        $user->username = $req->username;
        $user->name = $req->name;
        $user->password = bcrypt($req->password);
        $user->register_number = $this->generateRandomString(30);
        $user->utype = "ADM";
        $user->toponline = $req->proxy_id;
        $user->save();
        request()->session()->flash('status', '新增代理成功!');
        return redirect("/viewSubMember/$req->proxy_id")->withInput();
    }
}
