<?php

use App\Models\AuditLog;
use App\Models\Notification;
use App\Mail\SystemNotificationMail;
use Illuminate\Support\Facades\Mail;

if (!function_exists('sendSystemNotification')) {

    function sendSystemNotification($user, $message)
    {
        Notification::create([
            'user_id'  => $user->id,
            'message'  => $message,
            'status'   => 'SEND',
            'datetime' => now(),
        ]);

        AuditLog::create([
            'user_id'  => $user->id,
            'action'   => 'Sent system notification to user ID: ' . $user->id,
            'timestamp'=> now(),
        ]);

        Mail::to($user->email)->send(new SystemNotificationMail($message));
    }

}