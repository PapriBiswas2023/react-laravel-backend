<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ...

    public function register(Request $req)
    {
        $user = new User;
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password')); // Fix password hashing
        $user->save();
        
        return response()->json($user, 201); // Return the user and HTTP status code 201 (created)
    }

    public function login(Request $req)
    {
        $user = User::where('email', $req->input('email'))->first(); // Fix input key for email
        if (!$user || !Hash::check($req->input('password'), $user->password)) {
            return response()->json(['error' => 'Email or password is not matched'], 401); // Unauthorized status code
        }

        return response()->json($user, 200); // Return the user and HTTP status code 200 (OK)
    }
}
