<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AuditLog;
use App\Models\DonationRecord;
use App\Models\DonorHealthDetails;
use Illuminate\Http\Request;
use App\Models\MedicalFacility;
use App\Models\BloodInventory;
use App\Models\BloodBag;
use DB;
use Carbon\Carbon;
use App\Models\SystemSettings;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BloodUsageExport;
use App\Exports\InventoryExport;
use App\Exports\WastageExport;
use App\Exports\DonationHistoryExport;
use App\Models\Notification as NotificationModel;
use Illuminate\Support\Facades\Auth;

class MedicalFacilitiesController extends Controller
{
    public function medicalFacilitiesDashboard()
    {
        $user = auth()->user();
        $medical_facility_id = $user->facility_id;

        $medical_facility = MedicalFacility::find($medical_facility_id);

        $total_inventory = BloodInventory::where('medical_facilities_id', $medical_facility_id)
            ->sum('quantity');

        $expiring_soon_count = BloodBag::where('facility_id', $medical_facility_id)
            ->where('status', 'STORED')
            ->whereBetween('expires_at', [now(), now()->addDays(2)])
            ->count();

        $today_total = Appointment::whereHas('event', function ($q) use ($medical_facility_id) {
            $q->whereDate('date', today());
        })->count();

        $today_completed = Appointment::where('status', 'COMPLETED')
            ->whereHas('event', function ($q) use ($medical_facility_id) {
                $q->whereDate('date', today());
            })->count();

        $today_pending = $today_total - $today_completed;

        $bloodStocks = BloodInventory::where('medical_facilities_id', $medical_facility_id)
            ->get()
            ->keyBy('blood_type');

        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();

        return view('MedicalFacilities.dashboard', compact(
            'user',
            'medical_facility',
            'total_inventory',
            'expiring_soon_count',
            'today_total',
            'today_completed',
            'today_pending',
            'bloodStocks',
            'hasUnreadNotifications'
        ));
    }

    public function notification()
    {
        $user = auth()->user();
        $notifications = NotificationModel::where('user_id', $user->id)
            ->orderByRaw("status = 'READ'")
            ->orderBy('datetime', 'desc')
            ->paginate(10);

        return view('MedicalFacilities.notification', compact('user', 'notifications'));
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

    public function inventory_and_report()
    {
        $user = auth()->user();
        $blood_inventories = BloodInventory::where('medical_facilities_id', auth()->user()->facility_id)->get();
        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();
        return view('MedicalFacilities.inventory', compact('user', 'blood_inventories','hasUnreadNotifications'));
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
            ->where('appointment.status', 'ACCEPTED')
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

        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();

        return view('MedicalFacilities.donationManagement', compact('user', 'donation_today', 'donationHistory', 'recentRecords','hasUnreadNotifications'));
    }

    public function profile()
    {
        $user = auth()->user();
        $medical_facility = MedicalFacility::find($user->facility_id);
        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();
        return view('MedicalFacilities.profile', compact('user', 'medical_facility','hasUnreadNotifications'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->save();

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Updated profile information',
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
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

    public function bloodManagement(Request $request)
    {
        $user = auth()->user();

        $query = BloodBag::where('facility_id', $user->facility_id)->where('status', 'STORED');

        // Filter: blood type
        if ($request->filled('blood_type')) {
            $query->where('blood_type', $request->blood_type);
        }

        // Search: bag ID
        if ($request->filled('bag_id')) {
            $query->where('id', 'like', '%' . $request->bag_id . '%');
        }

        // Sorting
        if ($request->sort == 'expiry') {
            $query->orderBy('expires_at');
        } elseif ($request->sort == 'newest') {
            $query->orderByDesc('collected_at');
        } else {
            $query->orderBy('id'); // default
        }

        $bloodBags = $query->paginate(10)->withQueryString();

        $historyQuery = BloodBag::where('facility_id', $user->facility_id)
            ->whereIn('status', ['USED', 'EXPIRED']);

        if ($request->filled('history_status')) {
            $historyQuery->where('status', $request->history_status);
        }

        if ($request->filled('history_bag_id')) {
            $historyQuery->where('id', 'like', '%' . $request->history_bag_id . '%');
        }

        $history = $historyQuery
            ->orderByDesc('updated_at')
            ->paginate(10, ['*'], 'history_page')
            ->withQueryString();

        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();

        return view('MedicalFacilities.bloodManagement', compact('bloodBags', 'user', 'history','hasUnreadNotifications'));
    }

    public function recordDonationResult(Request $request, int $appointmentId)
    {
        $minHemoglobin = SystemSettings::where('name', 'min_hemoglobin')->value('value');
        if ($request->input('hemoglobin_level') < $minHemoglobin) {
            return redirect()->back()->with('error', 'Hemoglobin level is below the minimum required level of ' . $minHemoglobin . ' g/dL.');
        }
        $appointment = Appointment::where('id', $appointmentId)->first();
        $donorHealthDetails = DonorHealthDetails::where('donor_id', $appointment->donor_id)->first();
        $donorHealthDetails->hemoglobin_level = $request->input('hemoglobin_level');
        $donorHealthDetails->blood_pressure = $request->input('blood_pressure');
        $donorHealthDetails->last_donation_date = now();
        $donorHealthDetails->save();

        $bags = $request->input('unit');
        for ($i = 0; $i < $bags; $i++) {
            DonationRecord::create([
                'appointment_id' => $appointment->id,
                'donor_id' => $appointment->donor_id,
                'event_id' => $appointment->event_id,
                'facility_id' => auth()->user()->facility_id,
                'hemoglobin_level' => $request->input('hemoglobin_level'),
                'blood_pressure' => $request->input('blood_pressure'),
                'unit' => 1,
                'status' => $request->input('donation_status'),
                'staff_id' => auth()->user()->id,
                'collected_date' => now(),
                'expiration_date' => now()->addDays(42),
                'notes' => $request->input('notes'),
            ]);
        }

        $appointment->status = 'COMPLETED';
        $appointment->save();

        if ($request->input('donation_status') === 'SUCCESSFUL') {
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

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Recorded donation result for appointment ID: ' . $appointmentId,
            'timestamp' => now(),
        ]);

        sendSystemNotification($appointment->donor, 'Your donation result for the appointment on ' . $appointment->created_at->toDateString() . ' has been recorded as ' . $request->input('donation_status') . '.');

        return redirect()->back()->with('success', 'Donation result recorded successfully.');
    }

    public function useBloodBags(Request $request)
    {
        $bloodBagIds = $request->input('blood_bag_ids', []);
        if (empty($bloodBagIds)) {
            return redirect()->back()->with('error', 'No blood bags selected for usage.');
        }

        $bloodBags = BloodBag::whereIn('id', $bloodBagIds)
            ->where('facility_id', auth()->user()->facility_id)
            ->where('status', 'STORED')
            ->get();

        foreach ($bloodBags as $bloodBag) {
            $bloodBag->status = 'USED';
            $bloodBag->used_at = now();
            $bloodBag->save();
        }

        //Update inventory status
        $inventoryUpdates = $bloodBags->groupBy('blood_type')->map(function ($bags, $type) {
            return $bags->count();
        });
        foreach ($inventoryUpdates as $type => $usedCount) {
            $bloodInventory = BloodInventory::where('medical_facilities_id', auth()->user()->facility_id)
                ->where('blood_type', $type)
                ->first();
            if ($bloodInventory) {
                $bloodInventory->quantity -= $usedCount;
                $bloodInventory->save();
            }
        }

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Marked blood bags as used: ' . implode(', ', $bloodBagIds),
            'timestamp' => now(),
        ]);


        return redirect()->back()->with('success', 'Selected blood bags have been marked as used.');
    }

    public function exportInventoryReport(Request $request)
    {
        $facilityId = auth()->user()->facility_id;
        $now = now()->toDateString();
        $format = $request->input('format', 'xlsx');
        $facility_name = MedicalFacility::find($facilityId)->name;

        return Excel::download(new InventoryExport($facilityId), 'blood_inventory_' . $facility_name . '_' . $now . '.' . $format);
    }

    public function exportUsageReport(Request $request)
    {
        $facilityId = auth()->user()->facility_id;
        $from = $request->input('from') ?? '1900-01-01';
        $to = $request->input('to') ?? '2100-12-31';
        $format = $request->input('format', 'xlsx');

        if ($from > $to) {
            return redirect()->back()->with('error', 'Invalid date range: "From" date cannot be later than "To" date.');
        }

        return Excel::download(
            new BloodUsageExport($facilityId, $from, $to),
            'blood_usage_' . $from . '_to_' . $to . '.' . $format
        );
    }

    public function exportWastageReport(Request $request)
    {
        $facilityId = auth()->user()->facility_id;
        $from = $request->input('from') ?? '1900-01-01';
        $to = $request->input('to') ?? '2100-12-31';

        return Excel::download(
            new WastageExport($facilityId, $from, $to),
            'blood_wastage_' . $from . '_to_' . $to . '.xlsx'
        );
    }

    public function exportDonationRecords(Request $request)
    {
        $facilityName = MedicalFacility::find(auth()->user()->facility_id)->name;
        return Excel::download(
            new DonationHistoryExport(),
            'donation_records_' . $facilityName . "_" . now()->toDateString() . '.xlsx'
        );
    }
}
