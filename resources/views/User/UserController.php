<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function loginPage(){
        return view('user.login');
    }

    public function registerPage(){
        return view("user.register");
    }

    public function authLogin(Request $request){
        $sqlString = "SELECT * FROM users WHERE email = ? AND password = ?";

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            dd('Login successful');
        }

    }
}
