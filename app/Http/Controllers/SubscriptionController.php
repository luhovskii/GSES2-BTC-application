<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\BinanceController;
use App\Mail\MyTestEmail;

class SubscriptionController extends Controller
{
    const DATABASE_FILENAME = 'persist.txt';

    /**
     * Adds email to mailing list.
     */
    public function subscribeEmail() {
        $input = request()->collect();
        $email = $input->get('email');

        $subscriptions = self::retrieveSubscriptionsList();

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(
                "Invalid email.",
                400
            );
        }

        if (!in_array($email, $subscriptions)) {
            Storage::disk('local')->append(self::DATABASE_FILENAME, $email);
    
            return response()->json(
                sprintf(
                    "%s has been successfully added to the subscription list!",
                    $email
                ), 
                200
            );
        }
        
        return response()->json(
            sprintf(
                "You have already subscribed.",
                $email
            ), 
            409
        );
    }

    /**
     * Sends BTCUAH rate to subscribed users.
     */
    public function notifySubscribers() {
        $response = BinanceController::retrieveBtcUahData()->json();
        $emails = self::retrieveSubscriptionsList();

        foreach ($emails as $recipient) {
            Mail::to($recipient)->send(new MyTestEmail($response['price']));
        }
    
        return response()->json("Emails sent.", 200);
    }

    /**
     * Retrieves BTCUAH subscription emails.
     */
    public static function retrieveSubscriptionsList() {
        if ( Storage::disk('local')->exists(self::DATABASE_FILENAME) ) {
            $path = Storage::disk('local')->path(self::DATABASE_FILENAME);
            $content = File::get($path);
            return explode("\r\n", $content);
        }

        return [];
    }
}
