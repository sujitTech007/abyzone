<?php

// Simple test script to verify NotificationHelper functions
require_once 'vendor/autoload.php';

use App\Helpers\NotificationHelper;

echo "Testing NotificationHelper functions...\n\n";

// Test 1: sendToAdmin
echo "1. Testing sendToAdmin...\n";
try {
    $result = NotificationHelper::sendToAdmin(1, 'test', 'Test Admin Notification', 'This is a test message for admin');
    echo "✓ sendToAdmin works - Notification ID: " . ($result ? $result->id : 'null') . "\n";
} catch (Exception $e) {
    echo "✗ sendToAdmin failed: " . $e->getMessage() . "\n";
}

// Test 2: sendToOwner
echo "\n2. Testing sendToOwner...\n";
try {
    $result = NotificationHelper::sendToOwner(1, 'test', 'Test Owner Notification', 'This is a test message for owner');
    echo "✓ sendToOwner works - Notification ID: " . ($result ? $result->id : 'null') . "\n";
} catch (Exception $e) {
    echo "✗ sendToOwner failed: " . $e->getMessage() . "\n";
}

// Test 3: sendToUser
echo "\n3. Testing sendToUser...\n";
try {
    $result = NotificationHelper::sendToUser(1, 'test', 'Test User Notification', 'This is a test message for user');
    echo "✓ sendToUser works - Notification ID: " . ($result ? $result->id : 'null') . "\n";
} catch (Exception $e) {
    echo "✗ sendToUser failed: " . $e->getMessage() . "\n";
}

// Test 4: newBooking
echo "\n4. Testing newBooking...\n";
try {
    $result = NotificationHelper::newBooking(1, 'John Doe', 'Test Warehouse');
    echo "✓ newBooking works - Notification ID: " . ($result ? $result->id : 'null') . "\n";
} catch (Exception $e) {
    echo "✗ newBooking failed: " . $e->getMessage() . "\n";
}

// Test 5: bookingApproved
echo "\n5. Testing bookingApproved...\n";
try {
    $result = NotificationHelper::bookingApproved(1, 'Test Warehouse');
    echo "✓ bookingApproved works - Notification ID: " . ($result ? $result->id : 'null') . "\n";
} catch (Exception $e) {
    echo "✗ bookingApproved failed: " . $e->getMessage() . "\n";
}

// Test 6: bookingDeclined
echo "\n6. Testing bookingDeclined...\n";
try {
    $result = NotificationHelper::bookingDeclined(1, 'Test Warehouse');
    echo "✓ bookingDeclined works - Notification ID: " . ($result ? $result->id : 'null') . "\n";
} catch (Exception $e) {
    echo "✗ bookingDeclined failed: " . $e->getMessage() . "\n";
}

// Test 7: meetingScheduled
echo "\n7. Testing meetingScheduled...\n";
try {
    $result = NotificationHelper::meetingScheduled(1, 'Test Warehouse', '2024-01-15');
    echo "✓ meetingScheduled works - Notification ID: " . ($result ? $result->id : 'null') . "\n";
} catch (Exception $e) {
    echo "✗ meetingScheduled failed: " . $e->getMessage() . "\n";
}

// Test 8: userStatusChanged
echo "\n8. Testing userStatusChanged...\n";
try {
    $result = NotificationHelper::userStatusChanged(1, 'John Doe', 'customer', true);
    echo "✓ userStatusChanged works - Notification ID: " . ($result ? $result->id : 'null') . "\n";
} catch (Exception $e) {
    echo "✗ userStatusChanged failed: " . $e->getMessage() . "\n";
}

// Test 9: newUserRegistered
echo "\n9. Testing newUserRegistered...\n";
try {
    $result = NotificationHelper::newUserRegistered(1, 'Jane Doe', 'vendor');
    echo "✓ newUserRegistered works - Notification ID: " . ($result ? $result->id : 'null') . "\n";
} catch (Exception $e) {
    echo "✗ newUserRegistered failed: " . $e->getMessage() . "\n";
}

echo "\n\nAll tests completed!\n";
echo "Note: Run this script from your Laravel project root with: php test_notifications.php\n";