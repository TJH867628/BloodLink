<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DonationRecord;
use App\Models\DonorHealthDetails;
use Illuminate\Http\Request;
use App\Models\MedicalFacility;
use App\Models\BloodInventory;
use DB;
use Carbon\Carbon;

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
        $user = auth()->user();
        $blood_inventories = BloodInventory::where('medical_facilities_id', auth()->user()->facility_id)->get();
        return view('MedicalFacilities.inventory',compact('user', 'blood_inventories'));
    }

    public function donationManagement()
    {
        $user = auth()->user();

        $today = Carbon::today()->toDateString();
        $donation_today = DB::table('appointment')
            ->join('event', 'appointment.event_id', '=', 'event.id')
            ->join('users', 'appointment.donor_id', '=', 'users.id')
            ->join('donor_health_details', 'users.id', '=', 'donor_health_details.donor_id')
            ->whereDate('event.date', $today)
            ->where('appointment.status', 'APPROVED')
            ->select(
                'appointment.id as appointment_id',
                'users.name as donor_name',
                'donor_health_details.blood_type',
                'event.time',
                'event.date'
            )
            ->get();

        $recentRecords = DB::table('donation_record')
            ->join('users', 'donation_record.donor_id', '=', 'users.id')
            ->where('donation_record.facility_id', auth()->user()->facility_id)
            ->orderBy('donation_record.created_at', 'desc')
            ->limit(3)
            ->select(
                'donation_record.collected_date',
                'donation_record.status',
                'users.name as donor_name'
            )
        ->get();

        $donationHistory = DB::table('donation_record')
        ->join('users', 'donation_record.donor_id', '=', 'users.id')
        ->join('donor_health_details', 'donation_record.donor_id', '=', 'donor_health_details.donor_id')
        ->where('donation_record.facility_id', auth()->user()->facility_id)
        ->orderBy('donation_record.collected_date', 'desc')
        ->limit(50)
        ->select(
            'donation_record.collected_date',
            'donation_record.status',
            'donation_record.hemoglobin_level',
            'donation_record.blood_pressure',
            'users.name as donor_name',
            'users.id as donor_id',
            'donor_health_details.blood_type'
        )
        ->get();

        return view('MedicalFacilities.donationManagement', compact('user', 'donation_today','donationHistory','recentRecords'));
    }

    public function recordDonationResult(Request $request,int $appointmentId)
    {
        $appointment = Appointment::where('id', $appointmentId)->first();
        $donorHealthDetails = DonorHealthDetails::where('donor_id', $appointment->donor_id)->first();
        $donorHealthDetails->hemoglobin_level = $request->input('hemoglobin_level');
        $donorHealthDetails->blood_pressure = $request->input('blood_pressure');
        $donorHealthDetails->last_donation_date = now();
        $donorHealthDetails->save();
        DonationRecord::create([
            'appointment_id'    => $appointment->id,
            'donor_id'          => $appointment->donor_id,
            'event_id'          => $appointment->event_id,
            'facility_id'       => auth()->user()->facility_id,
            'hemoglobin_level'  => $request->input('hemoglobin_level'),
            'blood_pressure'   => $request->input('blood_pressure'),
            'unit'             => $request->input('unit'),
            'status'           => $request->input('donation_status'),
            'staff_id'        => auth()->user()->id,
            'collected_date'   => now(),
            'expiration_date' => now()->addDays(42),
            'notes'            => $request->input('notes'),
        ]);
        $appointment->status = 'COMPLETED';
        $appointment->save();

        if($request->input('donation_status') === 'SUCCESSFUL') {
            $bloodInventory = BloodInventory::where('medical_facilities_id', auth()->user()->facility_id)
                ->where('blood_type', $donorHealthDetails->blood_type)
                ->first();

            if ($bloodInventory) {
                $bloodInventory->quantity += $request->input('unit');
                $bloodInventory->save();
            } else {
                BloodInventory::create([
                    'blood_type' => $donorHealthDetails->blood_type,
                    'quantity' => $request->input('unit'),
                    'status' => 'OPTIMAL',
                    'medical_facilities_id' => auth()->user()->facility_id,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Donation result recorded successfully.');
    }
}
