<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PushNotificationEvent;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use App\Models\User;
use App\Models\PushSubscription;
use App\Models\GroupDocNotification;

class PushNotificationListener
{
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
     * @param  \App\Events\PushNotificationEvent  $event
     * @return void
     */
    public function handle(PushNotificationEvent $event)
    {
        $user = $event->user;;
        $usersub = $user->getSubscription->first();
        //return $usersub;
        $auth = [
                    'VAPID' => [
                        'subject' => env('VAPID_SUBJECT'),
                        'publicKey' => env('VAPID_PUBLIC_KEY'),
                        'privateKey' => env('VAPID_PRIVATE_KEY'),
                    ],
                    'timeout' => 20, // in seconds
                    'CURLOPT_SSL_VERIFYPEER' => false, // Unsafe in production!
                ];
        $subscription = Subscription::create(json_decode($usersub->subscription, true)); // Decode the stored subscription
        $webPush = new WebPush($auth);
        $notificationData = [
                        'title' => 'Your Notification Title',
                        'body' => 'Your notification body content here.',
                        // Add more data as needed
                    ];

        $report = $webPush->sendOneNotification(
                $subscription,
                json_encode($notificationData) // Payload must be a string
        );
        dd($report);
        /*$documentType = $event->document->id; // Assuming 'type' is mapped to 'document_id' in your table

        // Fetch the groups that need to be notified for this document type
        $notifiableGroups = GroupDocNotification::where('document_id', $documentType)
                                                ->pluck('group_id');

        foreach ($notifiableGroups as $groupId) {
            // Fetch all users in the group
            $groupUsers = User::where('user_group_id', $groupId)->get();

            // Send push notifications based on users in the push subscription table.
            foreach ($groupUsers as $user) {
               

                $auth = [
                    'VAPID' => [
                        'subject' => env('VAPID_SUBJECT'),
                        'publicKey' => env('VAPID_PUBLIC_KEY'),
                        'privateKey' => env('VAPID_PRIVATE_KEY'),
                    ],
                ];
                $getsubscriptions = $user->getSubscription;
                
                foreach ($getsubscriptions as $key => $subdata) {
                    $subscription = Subscription::create(json_decode($subdata->subscription, true)); // Decode the stored subscription
                    $webPush = new WebPush($auth);
                    $notificationData = [
                        'title' => 'Your Notification Title',
                        'body' => 'Your notification body content here.',
                        // Add more data as needed
                    ];

                    $report = $webPush->sendOneNotification(
                        $subscription,
                        json_encode($notificationData) // Payload must be a string
                    );
                }
                

                // Handle the report (success/failure) as shown in the previous message

                //return response()->json(['success' => true]);
            }
        }*/
    }
}
