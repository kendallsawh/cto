<?php
// app/Listeners/MarkNotificationAsSent.php
namespace App\Listeners;

use Illuminate\Mail\Events\MessageSent;
use App\Models\NotificationLog;
use App\Models\User;

class MarkNotificationAsSent
{
    public function handle(MessageSent $event): void
    {
        $headers = $event->message->getHeaders();

        $docTypeId    = (int) ($headers->get('X-Doc-Type-Id')->getBody() ?? 0);
        $documentRef  = (string) ($headers->get('X-Document-Ref')->getBody() ?? '');
        $toAddresses  = array_map(function ($a) { return $a->getAddress(); }, $event->message->getTo() ?? []);

        if (!$docTypeId || empty($documentRef) || empty($toAddresses)) {
            return;
        }

        // Find the user by email (works if emails are unique)
        $user = User::whereIn('email', $toAddresses)->first();
        if (!$user) return;

        NotificationLog::where([
            'user_id'     => $user->id,
            'doc_type_id' => $docTypeId,
            'document_ref'=> $documentRef,
            'channel'     => 'mail',
            'status'      => 'queued',
        ])->update(['status' => 'sent']);
    }
}
