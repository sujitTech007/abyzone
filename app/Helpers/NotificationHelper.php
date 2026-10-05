<?php

namespace App\Helpers;

use App\Models\Notification;

class NotificationHelper
{
    public static function send($userId, $userType, $type, $title, $message)
    {
        return Notification::create([
            'user_id' => $userId,
            'user_type' => $userType,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
        ]);
    }

    public static function sendToAdmin($adminId, $type, $title, $message)
    {
        return self::send($adminId, 'admin', $type, $title, $message);
    }

    public static function sendToOwner($ownerId, $type, $title, $message)
    {
        return self::send($ownerId, 'owner', $type, $title, $message);
    }

    public static function sendToUser($userId, $type, $title, $message)
    {
        // Get user to determine correct user_type
        $user = \App\Models\User::find($userId);
        if (!$user) return null;
        
        $userType = ($user->role === 'vendor') ? 'owner' : 'user';
        return self::send($userId, $userType, $type, $title, $message);
    }

    // Common notification types
    public static function newBooking($ownerId, $customerName, $warehouseName)
    {
        return self::sendToOwner(
            $ownerId,
            'booking',
            'New Booking Request',
            "You have received a new booking request from {$customerName} for {$warehouseName}."
        );
    }

    public static function bookingApproved($userId, $warehouseName)
    {
        return self::sendToUser(
            $userId,
            'booking',
            'Booking Approved',
            "Your booking request for {$warehouseName} has been approved."
        );
    }

    public static function bookingDeclined($userId, $warehouseName)
    {
        return self::sendToUser(
            $userId,
            'booking',
            'Booking Declined',
            "Your booking request for {$warehouseName} has been declined."
        );
    }

    public static function meetingScheduled($userId, $warehouseName, $meetingDate)
    {
        return self::sendToUser(
            $userId,
            'meeting',
            'Meeting Scheduled',
            "A meeting has been scheduled for {$warehouseName} on {$meetingDate}."
        );
    }

    public static function userStatusChanged($userId, $userName, $userType, $status)
    {
        $statusText = $status ? 'activated' : 'deactivated';
        return self::sendToUser(
            $userId,
            'user_status',
            'Account Status Changed',
            "Your account has been {$statusText} by the administrator."
        );
    }

    public static function newUserRegistered($adminId = 1, $userName, $userType)
    {
        return self::sendToAdmin(
            $adminId,
            'new_user',
            'New User Registration',
            "New {$userType} {$userName} has registered on the platform."
        );
    }
}