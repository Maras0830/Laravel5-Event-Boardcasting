<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;

    private $user;

    private $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Array $user, $message = '')
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Payload
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->user['id'],
            'username' => $this->user['username'],
            'message' => $this->message,
        ];
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['laravel-tutorial-event-channel-'.$this->user['id']];
    }
}
