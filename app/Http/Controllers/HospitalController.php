<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalFacility;

class HospitalController extends Controller
{
    //
    public function hospitalDashboard()
    {
        $user = auth()->user();
        $medical_facility_id = $user->facility_id;
        $medical_facility = MedicalFacility::find($medical_facility_id)->first();
        return view('hospital.dashboard',compact('user','medical_facility'));
    }

    public function inventory_and_report()
    {
        return view('hospital.inventory');
    }

    public function donationManagement()
    {
        return view('hospital.donationManagement');
    }
}
