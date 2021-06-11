<?php


namespace App\Notifications;


use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerification extends Notification
{
    use Queueable;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * @param $user
     * @return MailMessage
     */
    public function toMail($user)
    {
        if ($user->verify_code == 'done') {
            return (new MailMessage)
                ->line('You already verify')
                ->line('Thank you for using our application!');
        }
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->line('Enter this code, please:')
            ->line(['verify_code'=>$user->verify_code])
//                    ->action('Notification Action', url('/', ['id'=>$user->id,'verify_code'=>$user->verify_code]))
            ->line('Thank you for using our application!');
    }

}
