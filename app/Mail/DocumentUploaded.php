<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Events\DocumentUploadedEvent;
use App\Models\DocType; // <- ensure this namespace matches your app
use App\Models\User;

class DocumentUploaded extends Mailable
{
    use Queueable, SerializesModels;


   /** @var \App\Events\DocumentUploadedEvent */
    public DocumentUploadedEvent $event; // typed properties are fine in 7.4 (but not readonly)

    public function __construct(DocumentUploadedEvent $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // Resolve human-friendly fields here (NOT in Blade)
        $docTypeName = optional(DocType::find($this->event->doc_type_id))->doc_type_name
            ?? (string) $this->event->doc_type_id;

        $uploaderName = optional(User::find($this->event->uploaded_by_user_id))->name
            ?? (string) $this->event->uploaded_by_user_id;

        return $this->from(
            config('mail.from.address', 'no-reply@example.com'),
            config('mail.from.name', config('app.name'))
        )
        ->withSymfonyMessage(function ($message) {
            $headers = $message->getHeaders();
            $headers->addTextHeader('X-Doc-Type-Id', (string) $this->event->doc_type_id);
            $headers->addTextHeader('X-Document-Ref', (string) $this->event->url);
            $headers->addTextHeader('X-Uploaded-By', (string) $this->event->uploaded_by_user_id);
        })
        ->subject('New document uploaded: ' . $this->event->name)
        ->view('emails.document_uploaded')
        ->with([
            'name'         => $this->event->name,
            'description'  => $this->event->description,
            'url'          => $this->event->url,
            'docTypeName'  => $docTypeName,
            'uploaderName' => $uploaderName,
        ]);
    }
}
