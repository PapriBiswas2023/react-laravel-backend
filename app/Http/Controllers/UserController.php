<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function register(Request $req)
    {
        $user= new User;
        $user->username=$req->input('username');
        $user->useremail=$req->input('useremail');
        $user->password=$req->Hash::make(input('password'));
        $user->save();
        return $req->input();
    }
    function login(Request $req)
    {
        $user =User::where('useremail',$req->useremail)->first();
        if(!$user || !Hash::check($req->password,$user->password))
        {
            return response([
                'error'=>["Email or password is not matched"]
            ]);
        }
        return $user;
    }
    
}
