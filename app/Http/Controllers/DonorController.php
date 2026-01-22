<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Appointment;
use App\Models\DonationRecord;
use App\Models\Feedback;
use App\Models\BloodType;
use Carbon\Carbon;
use DB;

class DonorController extends Controller
{
    public function donorDashboard(){
        $user = Auth::user();
        $donorHealthDetails = $user->donorHealthDetails;
        $lastDonation = DonationRecord::where('donor_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
        return view('donor.dashboard',compact('user','donorHealthDetails', 'lastDonation'));
    }

    public function findEvent() {
        $user = Auth::user();
        $donorHealthDetails = $user->donorHealthDetails;
        $events = Event::all();
        $bookedEventId= Appointment::where('donor_id', $user->id)
            ->whereIn('status', ['PENDING', 'ACCEPTED'])
            ->pluck('event_id')
            ->toArray();
        $lastAcceptedDate = DB::table('appointment')
            ->join('event', 'appointment.event_id', '=', 'event.id')
            ->where('appointment.donor_id', $user->id)
            ->where('appointment.status', 'ACCEPTED')
            ->orderBy('event.date', 'desc')
            ->value('event.date');
        
        return view('donor.findEvent',compact('user','donorHealthDetails','events','bookedEventId','lastAcceptedDate'));
    }

    public function history() {
        $user = Auth::user();

        // Completed donations
        $donations = DonationRecord::join('event', 'donation_record.event_id', '=', 'event.id')
        ->leftJoin('medical_facilities', 'donation_record.facility_id', '=', 'medical_facilities.id')
        ->where('donation_record.donor_id', $user->id)
        ->select(
            'donation_record.*',
            'event.name as event_name',
            'medical_facilities.name as facility_name'
        )
        ->orderBy('donation_record.created_at', 'desc')
        ->get();

        // All appointments (pending / approved / cancelled)
        $appointments = Appointment::join('event', 'appointment.event_id', '=', 'event.id')
        ->where('appointment.donor_id', $user->id)
        ->whereNotIn('appointment.status', ['COMPLETED'])
        ->select(
            'appointment.*',
            'event.name as event_name',
            'event.location',
            'event.date',
            'event.time'
        )
        ->orderBy('appointment.created_at', 'desc')
        ->get();

        return view('donor.history',compact('user','appointments','donations'));
        $user = Auth::user();

        // Completed donations
        $donations = DonationRecord::join('event', 'donation_record.event_id', '=', 'event.id')
        ->leftJoin('medical_facilities', 'donation_record.facility_id', '=', 'medical_facilities.id')
        ->where('donation_record.donor_id', $user->id)
        ->select(
            'donation_record.*',
            'event.name as event_name',
            'medical_facilities.name as facility_name'
        )
        ->orderBy('donation_record.created_at', 'desc')
        ->get();

        // All appointments (pending / approved / cancelled)
        $appointments = Appointment::join('event', 'appointment.event_id', '=', 'event.id')
        ->where('appointment.donor_id', $user->id)
        ->whereNotIn('appointment.status', ['COMPLETED'])
        ->select(
            'appointment.*',
            'event.name as event_name',
            'event.location',
            'event.date',
            'event.time'
        )
        ->orderBy('appointment.created_at', 'desc')
        ->get();

        return view('donor.history',compact('user','appointments','donations'));
    }

    public function feedback() {
        $user = Auth::user();
        $donations = DonationRecord::join('event','donation_record.event_id','=','event.id')
        ->leftJoin('medical_facilities','donation_record.facility_id','=','medical_facilities.id')
        ->where('donation_record.donor_id',$user->id)
        ->select(
            'donation_record.id',
            'event.name as event_name',
            'medical_facilities.name as facility_name',
            'donation_record.created_at'
        )
        ->orderBy('donation_record.created_at','desc')
        ->get();

        $feedbacks = Feedback::where('user_id',$user->id)
        ->orderBy('created_at','desc')
        ->get();

        return view('donor.feedback',compact('user','donations','feedbacks'));
    }

    public function submitFeedback(Request $request) {
        $user = Auth::user();
        $donationId = $request->input('donation_id');
        $rating = $request->input('rating');
        $comment = $request->input('comments');

        if($donationId){
            $donation = DonationRecord::join('event','donation_record.event_id','=','event.id')
                ->where('donation_record.id', $donationId)
                ->select('event.name as event_name')
                ->first();

            $message = 
                "Feedback for Donation ID: $donationId\n" .
                "Event: " . ($donation ? $donation->event_name : 'Unknown') . "\n" .
                "Rating: $rating Star\n" .
                "Comment:\n $comment";
        }else{
            $message = 
                "Feedback\n" .
                "Rating: $rating Star\n" .
                "Comment:\n $comment";
        }
       
            
        Feedback::create([
            'user_id' => $user->id,
            'message' => $message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }

    public function bookEvent(Request $request, $eventId) {
        $user = Auth::user();

        if($user->donorHealthDetails->is_eligible == false){
            return redirect()->back()->with('error', 'You are not eligible to donate blood.');
        }


        $existingAppointment = Appointment::where('donor_id', $user->id)
            ->where('event_id', $eventId)
            ->whereIn('status', ['PENDING', 'ACCEPTED'])
            ->exists();
        
        if ($existingAppointment) {
            return redirect()->back()->with('error', 'You have already booked this event.');
        }

        $event = Event::find($eventId);
        if (!$event || $event->status != 'ACTIVE' || $event->available_slots <= 0) {
            return redirect()->back()->with('error', 'This event is not available for booking.');
        }

        $targetDate = Carbon::parse($event->date);
        $windowStart = $targetDate->copy()->subMonths(3);
        $windowEnd = $targetDate->copy()->addMonths(3);

        $hasAppointmentConflict = DB::table('appointment')
            ->join('event', 'appointment.event_id', '=', 'event.id')
            ->where('appointment.donor_id', $user->id)
            ->whereIn('appointment.status', ['ACCEPTED', 'COMPLETED'])
            ->whereBetween('event.date', [$windowStart, $windowEnd])
            ->exists();

        $healthDetails = $user->donorHealthDetails;
        $hasProfileConflict = false;
        if ($healthDetails && $healthDetails->last_donation_date) {
            $lastDonation = Carbon::parse($healthDetails->last_donation_date);

            if ($lastDonation->between($windowStart, $windowEnd)) {
                $hasProfileConflict = true;
            }
        }

        if ($hasAppointmentConflict || $hasProfileConflict) {
            return redirect()->back()->with('error', 'You already have a blood donation within 3 months of this event. Please choose a later date.');
        }

        Appointment::create([
            'donor_id' => $user->id,
            'event_id' => $eventId,
            'status' => 'PENDING',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $event->decrement('available_slots');

        return redirect()->back()->with('success', 'Event booked successfully!');
    }

    public function cancelAppointment(Request $request, $appointmentId) {
        $user = Auth::user();

        $appointment = Appointment::where('id', $appointmentId)
            ->where('donor_id', $user->id)
            ->first();

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        if ($appointment->status != 'PENDING' && $appointment->status != 'ACCEPTED') {
            return redirect()->back()->with('error', 'Only appointments that not completed can be cancelled.');
        }

        $appointment->status = 'CANCELLED';
        $appointment->save();

        $event = Event::find($appointment->event_id);
        if ($event) {
            $event->increment('available_slots');
        }

        return redirect()->back()->with('success', 'Appointment cancelled successfully!');
    }
    public function profile() {
        $user = Auth::user();
        $donorHealthDetails = $user->donorHealthDetails;
        $bloodTypes = BloodType::active()
                        ->orderBy('value')
                        ->get();

        return view('donor.profile', compact('user','donorHealthDetails', 'bloodTypes'));
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->save();

        $donorHealthDetails = $user->donorHealthDetails;
        if (!$donorHealthDetails) {
            $donorHealthDetails = new App\Models\DonorHealthDetails();
            $donorHealthDetails->donor_id = $user->id;
        }
        $donorHealthDetails->height = $request->input('height');
        $donorHealthDetails->weight = $request->input('weight');
        $donorHealthDetails->blood_type = $request->input('blood_type');
        $donorHealthDetails->blood_pressure = $request->input('blood_pressure');
        $donorHealthDetails->hemoglobin_level = $request->input('hemoglobin_level');
        $donorHealthDetails->medical_conditions = $request->input('medical_conditions');
        $donorHealthDetails->last_checkup_date = $request->input('last_checkup_date');
        $donorHealthDetails->last_donation_date = $request->input('last_donation_date');
        
        $donorHealthDetails->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }   
}
