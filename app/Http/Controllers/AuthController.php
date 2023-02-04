<?php

namespace App\Http\Controllers;

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
        function generateRandomString($length = 30) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $user = new User();

        $user->username = $req->username;
        $user->name = $req->name;
        $user->password = bcrypt($req->password);
        $user->register_number = generateRandomString(30);
        $user->utype = "ADM";
        $user->toponline = $req->proxy_id;
        $user->save();
        request()->session()->flash('status', '新增代理成功!');
        return redirect('/')->withInput();
        // return back()->withInput()->back();
    }

    public function changePassword(Request $req){
        $data = $req->validate([
            'password'=>[
                'required',
                'confirmed',
                'min:8'
            ]
        ]);
        log::info($req->member_id);
        $user = User::find($req->member_id);
        $user->password = bcrypt($req->password);
        $user->save();

        return redirect("/setMember/$req->member_id")->withInput();
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
}
