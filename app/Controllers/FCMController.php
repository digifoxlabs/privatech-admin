<?php
namespace App\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use CodeIgniter\Controller;

class FCMController extends Controller
{
    public function sendNotification()
    {
      // $firebase = (new Factory)->withServiceAccount(config('Firebase')->getFirebaseConfig());
      //$firebase = (new Factory)->withServiceAccount('../public/rts-security-fa478-firebase-adminsdk-88nor-c562f65ffc.json');
     // $firebase = (new Factory)->withServiceAccount($_ENV['GOOGLE_APPLICATION_CREDENTIALS']);
      $firebase = (new Factory)->withServiceAccount(ROOTPATH.$_ENV['GOOGLE_APPLICATION_CREDENTIALS']);

      $device_token = 'foara0OrT9iTXobyvdK70o:APA91bFIDvimDi_AHc_A0jl5PVzBd3Okkr4XXM8cR-2zE4m4K1PGWvcOuKeCBITYWwdlcS9iL9MX9W3tEoFDGdwcMDVWS2RnOqO5zgGFu8h4pEBbOh6cZbUliVInuLM49Vvh8TfbOIDa';
        $title = "Title";
        $body = "Notification";
        $action_to = "alert_device_stop";
        $topic = 'news_broadcast';


        $notification = [
        
        'title' => 'Hello',
        'body' => 'Good Morning'

        ];


    //   $data = [
    //     'device_token' => $device_token,
    //     'title' => $title,
    //     'body' => $body,
    //     'action_to' => $action_to,
    // ];


      $data = [

        'action_to' => $action_to,
    ];

        $messaging = $firebase->createMessaging();

        // Construct the FCM message
        // $message = CloudMessage::new()
        //     ->withNotification([
        //         'title' => $data['title'],
        //         'body' => $data['body'],
        //     ])
        //     ->withData([
        //         'action_to' => $data['action_to'],
        //     ])
        //     ->withTarget('token',$data['device_token'] );


            $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification($notification) // optional
            ->withData($data);



        // Send the FCM message
        $messaging->send($message);

        echo 'FCM notification sent!';
    }




    // public function sendNotification()
    // {
    //     // Load the Firebase configuration from the JSON key file
    //    // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/path/to/your/firebase-key.json');
    //     $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . base_url('public/rts-security-fa478-firebase-adminsdk-88nor-c562f65ffc.json'));
        
    //     print_r($serviceAccount);
    //     exit;

    //     $firebase = (new Factory)
    //         ->withServiceAccount($serviceAccount)
    //         ->create();

    //     $messaging = $firebase->getMessaging();

    //     // Create a message
    //     $message = CloudMessage::new()
    //         ->withNotification(['title' => 'Hello', 'body' => 'This is a notification.'])
    //         ->withData(['key' => 'value']) // Optional data payload
    //         ->withTarget('token', 'YOUR_DEVICE_TOKEN'); // The FCM token of the target device

    //     // Send the message
    //     $messaging->send($message);

    //     echo "FCM notification sent!";
    // }







}
?>