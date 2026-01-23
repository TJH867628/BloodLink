<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalFacility;

class MedicalFacilitiesController extends Controller
{
    //
    public function medicalFacilitiesDashboard()
    {
        $user = auth()->user();
        $medical_facility_id = $user->facility_id;
        $medical_facility = MedicalFacility::find($medical_facility_id)->first();
        return view('MedicalFacilities.dashboard',compact('user','medical_facility'));
    }

    public function inventory_and_report()
    {
        return view('MedicalFacilities.inventory');
    }

    public function donationManagement()
    {
        return view('MedicalFacilities.donationManagement');
    }
}
