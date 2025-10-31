<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use App\Models\User; // or your User model path
use App\Models\PushSubscription;

class PushNotificationController extends Controller
{
    // Method to store the subscription object in your database
    public function storeSubscription(Request $request)
    {
       
        $user = auth()->user(); // Or however you retrieve your user
        /*
        // Assuming you have a method to save this subscription to your user. didnt work for some reason not gonna waste time found a new way
        $user->update([
            'subscription' => $request->getContent(), // Directly storing the JSON string
        ]);*/

        PushSubscription::create(['subscription'=>$request->getContent(), 'user_id' => $user->id]);

        return response()->json(['success' => true]);
    }

    // Method to send a notification
    public function sendNotification(Request $request)
    {
        $user = auth()->user(); // Retrieve the user to whom you're sending the notification

        $subscription = Subscription::create(json_decode($user->subscription, true)); // Decode the stored subscription

        $auth = [
            'VAPID' => [
                'subject' => env('VAPID_SUBJECT'),
                'publicKey' => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
            ],
        ];

        $webPush = new WebPush($auth);
        $notificationData = [
            'title' => 'Your Notification Title',
            'body' => 'Your notification body content here.',
            // Add more data as needed
        ];

        $report = $webPush->sendNotification(
            $subscription,
            json_encode($notificationData), // Payload must be a string
            true // Whether to flush the queue after sending
        );

        // Handle the report (success/failure) as shown in the previous message

        return response()->json(['success' => true]);
    }

    // Add more methods as needed, for example, to list or delete subscriptions
}
