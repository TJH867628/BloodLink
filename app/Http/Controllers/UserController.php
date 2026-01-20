<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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

    public function submitRegister(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = bcrypt($request->input('password'));

        if(User::where('email', $email)->exists()){
            return redirect()->back()->with('error', 'Email already registered.');
        }

        User::create(
            [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
            ]
        );
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function authLogin(Request $request){
        $sqlString = "SELECT * FROM users WHERE email = ? AND password = ?";

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            dd('Login successful');
        }

    }
}
