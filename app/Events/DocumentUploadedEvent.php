<?php

namespace App\Events;

//use Illuminate\Broadcasting\Channel;
//use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DocumentUploadedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * @var int
     */
    public $doc_type_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string|null
     */
    public $description;

    /**
     * @var int
     */
    public $uploaded_by_user_id;

    /**
     * @var string
     */
    public $url;

    /**
     * Create a new event instance.
     *
     * @param int $doc_type_id // or string for the doc type code
     * @param string $name
     * @param string|null $description
     * @param int $uploaded_by_user_id
     * @param string $url
     * @return void
     */
    public function __construct(
        int    $doc_type_id,
        string $name,
        ?string $description,
        int    $uploaded_by_user_id,
        string $url
    ) {
        $this->doc_type_id = $doc_type_id;
        $this->name = $name;
        $this->description = $description;
        $this->uploaded_by_user_id = $uploaded_by_user_id;
        $this->url = $url;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
