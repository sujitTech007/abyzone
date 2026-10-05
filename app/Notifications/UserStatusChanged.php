<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class UserStatusChanged extends Notification
{
    use Queueable;

    public $user;
    public $status;

    public function __construct(User $user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $statusText = $this->status ? 'activated' : 'deactivated';
        
        return (new MailMessage)
                    ->subject('Account Status Changed')
                    ->line('Your account has been ' . $statusText . ' by an administrator.')
                    ->line('Status: ' . ($this->status ? 'Active' : 'Inactive'))
                    ->line('If you have any questions, please contact support.');
    }

    public function toArray($notifiable)
    {
        $statusText = $this->status ? 'activated' : 'deactivated';
        
        return [
            'message' => 'Your account has been ' . $statusText . ' by an administrator.',
            'status' => $this->status ? 'active' : 'inactive',
            'user_id' => $this->user->id
        ];
    }
}