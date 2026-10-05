<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $userType = $this->getUserType();
        $userId = auth()->id();
        
        $notifications = Notification::forUser($userId, $userType)
            ->latest()
            ->paginate(10);
            
        return view($this->getViewPath() . '.notifications', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $notification = Notification::findOrFail($request->id);
        $notification->markAsRead();
        
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        $userType = $this->getUserType();
        $userId = auth()->id();
        
        Notification::forUser($userId, $userType)->unread()->update(['is_read' => true]);
        
        return back()->with('success', 'All notifications marked as read');
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        
        return response()->json(['success' => true]);
    }

    private function getUserType()
    {
        if (auth()->guard('admin')->check()) return 'admin';
        
        $user = auth()->user();
        if ($user && $user->role === 'vendor') return 'owner';
        
        return 'user';
    }

    private function getViewPath()
    {
        $userType = $this->getUserType();
        return $userType === 'admin' ? 'admin' : $userType;
    }

    public static function create($userId, $userType, $type, $title, $message)
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
}