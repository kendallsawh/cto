<?php

namespace App\Listeners;

use App\Events\DocumentUploadedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\GroupDocNotification;
use App\Models\User;
use App\Models\NotificationLog;
use App\Jobs\SendDocumentEmail;
//use Illuminate\Support\Facades\Mail;
//use App\Mail\DocumentUploaded;

class SendDocumentUploadedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public int $tries = 3;
    public $backoff = [60, 300, 900]; // 1m, 5m, 15m
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\DocumentUploadedEvent  $event
     * @return void
     */


    public function handle(DocumentUploadedEvent $event): void
    {
        // Which groups should get emails for this doc type?
        $groupIds = GroupDocNotification::query()
            ->where('doc_type_id', $event->doc_type_id) // consider renaming to doc_type_id
            ->pluck('group_id');

        if ($groupIds->isEmpty()) {
            return; // nothing to notify
        }
        $documentRef = (string) ($event->document_ref ?? $event->url); // currently the url is the url of the psip not the document.

        $payload = [
            'doc_type_id'          => $event->doc_type_id,
            'name'                 => $event->name,
            'description'          => $event->description,
            'uploaded_by_user_id'  => $event->uploaded_by_user_id,
            'url'                  => $event->url,
            'document_ref'        => $documentRef,
        ];

        // Fetch all users in one query, skip null emails, dedupe just in case
        User::query()
            ->whereIn('user_group_id', $groupIds)
            ->whereNotNull('email')
            ->select(['id', 'name', 'email'])
            ->distinct()
            ->chunk(500, function ($users) use ($event, $documentRef, $payload) {
                foreach ($users as $user) {
                     // Idempotency check
                    $alreadySent = NotificationLog::where([
                        'user_id'     => $user->id,
                        'doc_type_id' => $event->doc_type_id,
                        'document_ref'=> $documentRef,
                        'channel'     => 'mail',
                    ])->exists();

                    if ($alreadySent) {
                        continue;
                    }

                    // Create a "queued" log BEFORE dispatch to block duplicates
                    NotificationLog::create([
                        'user_id'     => $user->id,
                        'doc_type_id' => $event->doc_type_id,
                        'document_ref'=> $documentRef,
                        'channel'     => 'mail',
                        'status'      => 'queued',
                    ]);

                    // Queue the mailable
                    /* Mail::to($user->email)->queue(
                        new DocumentUploaded($event) // pass event or DTO
                    ); */

                    SendDocumentEmail::dispatch(
                        $user->id,
                        $user->email,
                        $event->doc_type_id,
                        $documentRef, // e.g. $event->url or a storage path
                        $payload
                    );


                }
            });
    }


}
