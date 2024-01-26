<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function register()
    {
        $user= new User;
        $user->username=$req->input('username');
        $user->useremail=$req->input('useremail');
        $user->password=$req->Hash::make(input('password'));
        $user->save();
        return $req->input();
    }
}
