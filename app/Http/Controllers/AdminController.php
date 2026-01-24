<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\MedicalFacility;
use App\Models\SystemSettings;
use App\Models\User;
use App\Models\BloodInventory;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    //
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalMedicalFacilities = MedicalFacility::count();
        $currentBloodStock = BloodInventory::sum('quantity');
        $emergencyMode = SystemSettings::where('name', 'emergency_mode')->value('value');
        $logs = AuditLog::with('user')
        ->orderBy('timestamp', 'desc')
        ->limit(5)
        ->get();
        return view('Admin.dashboard', compact('totalUsers', 'totalMedicalFacilities', 'currentBloodStock', 'emergencyMode', 'logs'));
    }
    public function userManagement()
    {
        $users = User::all();
        $facilities = MedicalFacility::all();
        $emergencyMode = SystemSettings::where('name', 'emergency_mode')->value('value');
        return view('Admin.userManagement', compact('users', 'facilities','emergencyMode'));
    }
    public function medicalFacilitiesManagement()
    {
        $facilities = MedicalFacility::all();
        $emergencyMode = SystemSettings::where('name', 'emergency_mode')->value('value');
        return view('Admin.medicalFacilitiesManagement', compact('facilities'),compact('emergencyMode'));
    }
    public function systemModification()
    {
        $settings = SystemSettings::pluck('value', 'name');
        return view('Admin.systemModification',compact('settings'));
    }
    public function auditReport()
    {
        $emergencyMode = SystemSettings::where('name', 'emergency_mode')->value('value');
        $logs = DB::table('audit_log')
        ->leftJoin('users', 'audit_log.user_id', '=', 'users.id')
        ->select(
            'audit_log.*',
            'users.id as user_id',
            'users.name as user_name',
            'users.role as user_role'
        )
        ->orderBy('audit_log.timestamp', 'desc')
        ->get();

        return view('Admin.auditReport', compact('emergencyMode', 'logs'));
    }

    public function toggleUserActivation($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => ($user->is_active ? 'Activated' : 'Deactivated') . ' user: ' . $user->name . ' (ID: ' . $user->id . ')',
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'User activation status updated successfully.');
    }

    public function createUser(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $role = $request->input('role');
        $password = bcrypt($request->input('password'));
        $status = $request->input('status') === 'active' ? 1 : 0;
        $facilities_id = $request->input('facilities_id');

        User::create([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'password' => $password,
            'is_active' => $status,
            'facilities_id' => $facilities_id,
        ]);

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Created user: ' . $name . ' with role: ' . $role,
            'timestamp' => now(),
        ]);


        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function createMedicalFacility(Request $request)
    {
        $name = $request->input('name');
        $type = $request->input('type');
        $address = $request->input('address');

        MedicalFacility::create([
            'name' => $name,
            'type' => $type,
            'address' => $address,
        ]);

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Created medical facility: ' . $name . ' of type: ' . $type,
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Medical Facility created successfully.');
    }

    public function editMedicalFacility(Request $request, $facilityId)
    {
        $facility = MedicalFacility::findOrFail($facilityId);

        $facility->name = $request->input('name');
        $facility->type = $request->input('type');
        $facility->address = $request->input('address');
        $facility->save();

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Edited medical facility ID: ' . $facilityId,
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Medical Facility updated successfully.');
    }

    public function updateSystemSettings(Request $request)
    {
        $oldEmergency = SystemSettings::where('name','emergency_mode')->value('value') ?? 0;
        $newEmergency = $request->has('emergency_mode') ? 1 : 0;

        $settings = [
            'min_hemoglobin' => $request->input('min_hemoglobin'),
            'emergency_mode' => $newEmergency,
        ];

        if ($newEmergency) {
            $settings['donation_interval_months'] = 2;
            $settings['inventory_critical_pct'] = 25;
            $settings['inventory_warning_pct'] = 40;
            $settings['inventory_optimal_pct'] = 90;
        } else {
            // Normal Mode
            $settings['donation_interval_months'] = 3;
            $settings['inventory_critical_pct'] = 15;
            $settings['inventory_warning_pct'] = 30;
            $settings['inventory_optimal_pct'] = 80;
        }

        $settings['inventory_target_units'] = $request->input('inventory_target_units');

        foreach ($settings as $name => $value) {
            SystemSettings::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );
        }

        if ($oldEmergency == 0 && $newEmergency == 1) {
            $this->sendEmergencyAlerts();
        }

        // Audit Log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated system settings. Emergency mode: ' . ($newEmergency ? 'ON' : 'OFF'),
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'System settings updated successfully.');
    }

    private function sendEmergencyAlerts()
    {
        $donors = User::where('role', 'DONOR')
                    ->get();

        foreach ($donors as $donor) {
            sendSystemNotification(
                $donor,
                " Blood shortage emergency! Please check your eligibility and book an appointment if you can donate"
            );
        }
    }

    public function inventory()
    {
        $user = auth()->user();
        $blood_inventories = BloodInventory::with('medicalFacility')->get();
        $bloodTypeSummary = BloodInventory::selectRaw('blood_type, SUM(quantity) as total')
        ->groupBy('blood_type')
        ->get();

        $settings = SystemSettings::pluck('value', 'name');

        return view('Admin.inventory',compact('user', 'blood_inventories', 'bloodTypeSummary','settings'));
    }
}

