<?php
// app/Jobs/SendDocumentEmail.php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentUploaded;
use App\Models\NotificationLog;

class SendDocumentEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userId;
    public $email;
    public $docTypeId;
    public $documentRef;
    public $eventPayload; // serialize what your mailable needs

    public $tries = 3;
    public $backoff = [60, 300, 900];

    public function __construct($userId, $email, $docTypeId, $documentRef, array $eventPayload)
    {
        $this->userId      = $userId;
        $this->email       = $email;
        $this->docTypeId   = $docTypeId;
        $this->documentRef = $documentRef;
        $this->eventPayload= $eventPayload;
    }

    public function handle(): void
    {
        // queued log row should already exist with status=queued (from your listener)
        try {
            Mail::to($this->email)->send(new DocumentUploaded(
                // reconstruct your event object or pass a DTO array to the mailable’s ctor
                new \App\Events\DocumentUploadedEvent(
                    (int)$this->eventPayload['doc_type_id'],
                    (string)$this->eventPayload['name'],
                    $this->eventPayload['description'],
                    (int)$this->eventPayload['uploaded_by_user_id'],
                    (string)$this->eventPayload['url']
                )
            ));

            // SwiftMailer exposes failures via Mail::failures() when using ->send()
            $failed = Mail::failures();
            NotificationLog::where([
                'user_id'     => $this->userId,
                'doc_type_id' => $this->docTypeId,
                'document_ref'=> $this->documentRef,
                'channel'     => 'mail',
                'status'      => 'queued',
            ])->update([
                'status' => empty($failed) ? 'sent' : 'failed',
                'error'  => empty($failed) ? null : json_encode($failed),
            ]);
        } catch (\Throwable $e) {
            NotificationLog::where([
                'user_id'     => $this->userId,
                'doc_type_id' => $this->docTypeId,
                'document_ref'=> $this->documentRef,
                'channel'     => 'mail',
                'status'      => 'queued',
            ])->update([
                'status' => 'failed',
                'error'  => $e->getMessage(),
            ]);

            // rethrow to let the queue retry/backoff policy apply
            throw $e;
        }
    }
}
