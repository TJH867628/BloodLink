<?php

namespace App\Http\Controllers;

use App;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Appointment;
use App\Models\DonationRecord;
use App\Models\Feedback;
use App\Models\BloodType;
use App\Models\SystemSettings;
use App\Models\Notification as NotificationModel;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Notification;

class DonorController extends Controller
{
    public function donorDashboard()
    {
        $user = Auth::user();
        $donorHealthDetails = $user->donorHealthDetails;
        $recentActivities = DB::table('appointment')
            ->join('event', 'appointment.event_id', '=', 'event.id')
            ->where('appointment.donor_id', auth()->id())
            ->orderBy('appointment.updated_at', 'desc')
            ->limit(5)
            ->select(
                'event.name',
                'event.date',
                'event.time',
                'appointment.status',
                'appointment.updated_at'
            )
            ->get();
        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();
        return view('donor.dashboard', compact('user', 'donorHealthDetails', 'recentActivities', 'hasUnreadNotifications'));
    }

    public function findEvent()
    {
        $user = Auth::user();
        $donorHealthDetails = $user->donorHealthDetails;
        $events = Event::orderBy('date', 'desc')->get();
        $bookedEventId = Appointment::where('donor_id', $user->id)
            ->whereIn('status', ['PENDING', 'ACCEPTED'])
            ->pluck('event_id')
            ->toArray();
        $lastAcceptedDate = DB::table('appointment')
            ->join('event', 'appointment.event_id', '=', 'event.id')
            ->where('appointment.donor_id', $user->id)
            ->where('appointment.status', 'ACCEPTED')
            ->orderBy('event.date', 'desc')
            ->value('event.date');
        $intervalMonths = SystemSettings::where('name', 'donation_interval_months')->value('value');
        $intervalMonths = (int) $intervalMonths ?: 3;
        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();
        return view('donor.findEvent', compact('user', 'donorHealthDetails', 'events', 'bookedEventId', 'lastAcceptedDate', 'intervalMonths','hasUnreadNotifications'));
    }

    public function history()
    {
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
        
        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();

        return view('donor.history', compact('user', 'appointments', 'donations','hasUnreadNotifications'));
    }

    public function feedback()
    {
        $user = Auth::user();
        $donations = DonationRecord::join('event', 'donation_record.event_id', '=', 'event.id')
            ->leftJoin('medical_facilities', 'donation_record.facility_id', '=', 'medical_facilities.id')
            ->where('donation_record.donor_id', $user->id)
            ->select(
                'donation_record.id',
                'event.name as event_name',
                'medical_facilities.name as facility_name',
                'donation_record.created_at'
            )
            ->orderBy('donation_record.created_at', 'desc')
            ->get();

        $feedbacks = Feedback::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();

        return view('donor.feedback', compact('user', 'donations', 'feedbacks','hasUnreadNotifications'));
    }

    public function submitFeedback(Request $request)
    {
        $user = Auth::user();
        $donationId = $request->input('donation_id');
        $rating = $request->input('rating');
        $comment = $request->input('comments');

        if ($donationId) {
            $donation = DonationRecord::join('event', 'donation_record.event_id', '=', 'event.id')
                ->where('donation_record.id', $donationId)
                ->select('event.name as event_name')
                ->first();

            $message =
                "Feedback for Donation ID: $donationId\n" .
                "Event: " . ($donation ? $donation->event_name : 'Unknown') . "\n" .
                "Rating: $rating Star\n" .
                "Comment:\n $comment";
        } else {
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

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Submitted feedback for Donation ID: ' . ($donationId ?? 'N/A'),
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }

    public function bookEvent(Request $request, $eventId)
    {
        $user = Auth::user();

        if ($user->donorHealthDetails->is_eligible == false) {
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
        $intervalMonths = SystemSettings::where('name', 'donation_interval_months')->value('value');
        $intervalMonths = (int) $intervalMonths ?: 3;
        $targetDate = Carbon::parse($event->date);
        $windowStart = $targetDate->copy()->subMonths($intervalMonths);
        $windowEnd = $targetDate->copy()->addMonths($intervalMonths);

        $hasFutureAppointment = DB::table('appointment')
            ->join('event', 'appointment.event_id', '=', 'event.id')
            ->where('appointment.donor_id', $user->id)
            ->where('appointment.status', 'ACCEPTED')
            ->whereDate('event.date', '>=', now())
            ->exists();

        $healthDetails = $user->donorHealthDetails;
        $hasProfileConflict = false;
        $lastDonation = $user->donorHealthDetails->last_donation_date;

        if ($lastDonation) {
            $nextEligible = Carbon::parse($lastDonation)->addMonths($intervalMonths);

            if ($targetDate->lt($nextEligible)) {
                $hasProfileConflict = true;
            }
        }
        if ($hasFutureAppointment || $hasProfileConflict) {
            return redirect()->back()->with(
                'error',
                "You already have a blood donation within the required {$intervalMonths} month waiting period. Please choose a later date."
            );
        }

        Appointment::create([
            'donor_id' => $user->id,
            'event_id' => $eventId,
            'status' => 'PENDING',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Booked event ID: ' . $eventId,
            'timestamp' => now(),
        ]);

        $organizer = User::find($event->organizer_id);

        sendSystemNotification($organizer, 'A new appointment has been booked for your event "' . $event->name . '" by ' . $user->name . '.');
        sendSystemNotification($user, 'You have successfully booked an appointment for the event "' . $event->name . '" on ' . $event->date . '.');

        $event->decrement('available_slots');

        return redirect()->back()->with('success', 'Event booked successfully!');
    }

    public function cancelAppointment(Request $request, $appointmentId)
    {
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

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Cancelled appointment ID: ' . $appointmentId,
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Appointment cancelled successfully!');
    }
    public function profile()
    {
        $user = Auth::user();
        $donorHealthDetails = $user->donorHealthDetails;
        $bloodTypes = BloodType::active()
            ->orderBy('value')
            ->get();

        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();

        return view('donor.profile', compact('user', 'donorHealthDetails', 'bloodTypes','hasUnreadNotifications'));
    }

    public function updateProfile(Request $request)
    {
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
        $donorHealthDetails->last_donation_date = $request->input('last_donation_date');

        $donorHealthDetails->save();

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Updated profile information',
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function notification()
    {
        $user = Auth::user();
        $notifications = NotificationModel::where('user_id', $user->id)
            ->orderByRaw("status = 'READ'")
            ->orderBy('datetime', 'desc')
            ->get();
        return view('donor.notification', compact('user', 'notifications'));
    }

    public function markNotificationAsRead(Request $request, $notificationId)
    {
        $user = Auth::user();

        $notification = NotificationModel::where('id', $notificationId)
            ->where('user_id', $user->id)
            ->first();

        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found.');
        }

        $notification->status = 'READ';
        $notification->save();

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function markAllNotificationsAsRead(Request $request)
    {
        $user = Auth::user();

        NotificationModel::where('user_id', $user->id)
            ->where('status', 'SEND')
            ->update(['status' => 'READ']);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
        ]);
        if (!password_verify($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        if ($request->input('new_password') !== $request->input('confirm_password')) {
            return redirect()->back()->with('error', 'New password and confirmation do not match.');
        }

        if ($request->input('current_password') === $request->input('new_password')) {
            return redirect()->back()->with('error', 'New password cannot be the same as the current password.');
        }

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Changed account password',
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
