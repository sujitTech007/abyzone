<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\View;

class ShareNotificationCount
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $userType = ($user->role === 'vendor') ? 'owner' : 'user';
            
            $unreadCount = Notification::forUser($user->id, $userType)->unread()->count();
            
            View::share('unreadNotificationCount', $unreadCount);
        }

        return $next($request);
    }
}