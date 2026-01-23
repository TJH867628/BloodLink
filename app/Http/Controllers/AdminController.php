<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function adminDashboard()
    {
        return view('Admin.dashboard');
    }
    public function userManagement()
    {
        return view('Admin.userManagement');
    }
    public function hospitalManagement()
    {
        return view('Admin.hospitalManagement');
    }
    public function systemModification()
    {
        return view('Admin.systemModification');
    }
    public function auditReport()
    {
        return view('Admin.auditReport');
    }
}