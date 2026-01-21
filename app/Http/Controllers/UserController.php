<?php

namespace App\Http\Controllers;

use App\Models\DonorHealthDetails;
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

        $user = User::create(
            [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'role' => 'DONOR'
            ]
        );

        DonorHealthDetails::create([
            'donor_id' =>  $user->id,
            'height' => $request->height,
            'weight' => $request->weight,
            'blood_pressure' => $request->blood_pressure,
            'hemoglobin_level' => $request->hemoglobin_level,
            'medical_conditions' => $request->medical_conditions,
            'last_checkup_date' => $request->last_checkup_date,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function authLogin(Request $request){
        $sqlString = "SELECT * FROM users WHERE email = ? AND password = ?";

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            switch (Auth::user()->role) {
                case 'ADMIN':
                    return redirect()->route('admin.dashboard');
                case 'DONOR':
                    return redirect()->route('donor.dashboard');
                case 'ORGANIZER':
                    return redirect()->route('organizer.dashboard');
                case 'STAFF':
                    return redirect()->route('staff.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Invalid role.');
            }
        }else{
            return redirect()->route('login')->with('error', 'Invalid credentials.');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }   
}
