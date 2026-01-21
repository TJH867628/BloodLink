<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HospitalController extends Controller
{
    //
    public function hospitalDashboard()
    {
        return view('hospital.dashboard');
    }

    public function inventory_and_report()
    {
        return view('hospital.inventory');
    }

    public function donorManagement()
    {
        return view('hospital.donorManagement');
    }
}
