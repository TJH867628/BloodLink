<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function donorDashboard(){
        return view('donor.dashboard');
    }

    public function findEvent() {
        return view('donor.findEvent');
    }

    public function history() {
        return view('donor.history');
    }

    public function feedback() {
        return view('donor.feedback');
    }
    public function profile() {
        return view('donor.profile');
    }
}
