<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;
class AuthController extends Controller
{
    public function register(Request $req){
        // $validator = Validator::make($req->all(), [
        //     'account' => 'required',
        //     'phone' => 'number|unique:users',
        //     'name' => 'required|string',
        //     'password' => 'required|string|confirmed|min:6',
        //     'register_number'=> 'string',
        // ]);
        log::info($req);
        $user_id = NULL;
        if($req['register_number'] != NULL){
            $user_id = User::where('register_number', $req['register_number'])->first()->id;
        }
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
        $user->phone = $req->phone;
        $user->name = $req->name;
        $user->password = bcrypt($req->password);
        $user->register_number = generateRandomString(30);
        $user->toponline = $user_id;
        $user->utype = "ADM";
        $user->toponline = Auth::user()->id;
        $user->save();
        request()->session()->flash('status', '新增代理成功!');
        return redirect('/')->withInput();
        // return back()->withInput()->back();
    }
}