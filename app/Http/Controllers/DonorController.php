<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Appointment;
use App\Models\DonationRecord;
use App\Models\Feedback;

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
        return view('donor.findEvent',compact('user','donorHealthDetails','events'));
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


        $donation = DonationRecord::join('event','donation_record.event_id','=','event.id')
            ->where('donation_record.id', $donationId)
            ->select('event.name as event_name')
            ->first();

        $message = 
            "Feedback for Donation ID: $donationId\n" .
            "Event: " . ($donation ? $donation->event_name : 'Unknown') . "\n" .
            "Rating: $rating\n" .
            "Comment:\n $comment";
            
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
        $existingAppointment = Appointment::where('donor_id', $user->id)
            ->where('event_id', $eventId)
            ->exists();

        if ($existingAppointment) {
            return redirect()->back()->with('error', 'You have already booked this event.');
        }

        $event = Event::find($eventId);
        if (!$event || $event->status != 'ACTIVE' || $event->available_slots <= 0) {
            return redirect()->back()->with('error', 'This event is not available for booking.');
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
    public function profile() {
        return view('donor.profile');
    }
}
