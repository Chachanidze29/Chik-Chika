<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Commented extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected string $username,protected int $postId,protected int $commentId)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
//        commentRoute using $this->commentId
        return [
            'username'=>$this->username,
            'text1'=>'Has Wrote ',
            'text2'=>'A On Your ',
            'postRoute'=>route('post',$this->postId),
            'commentRoute'=>route('post',$this->commentId)
        ];
    }
}
