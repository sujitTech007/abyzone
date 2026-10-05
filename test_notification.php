<?php
require_once 'vendor/autoload.php';

// Test notification creation
use App\Helpers\NotificationHelper;
use App\Models\User;
use App\Models\Notification;

// Test creating notifications for different user types
$testUserId = 1; // Replace with actual user ID
$testOwnerUserId = 2; // Replace with actual owner user ID

// Test user status change notification
NotificationHelper::userStatusChanged($testUserId, 'Test User', 'customer', 1);

// Test owner notification
NotificationHelper::newBooking($testOwnerUserId, 'Test Customer', 'Test Warehouse');

// Check if notifications were created
$userNotifications = Notification::forUser($testUserId, 'user')->get();
$ownerNotifications = Notification::forUser($testOwnerUserId, 'owner')->get();

echo "User notifications: " . $userNotifications->count() . "\n";
echo "Owner notifications: " . $ownerNotifications->count() . "\n";

foreach($userNotifications as $notification) {
    echo "User: " . $notification->title . " - " . $notification->message . "\n";
}

foreach($ownerNotifications as $notification) {
    echo "Owner: " . $notification->title . " - " . $notification->message . "\n";
}