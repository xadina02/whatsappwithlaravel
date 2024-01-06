<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendWhatsAppMessage()
    {
        $twilioSid = config('services.twilio.sid');
        $twilioToken = config('services.twilio.token');
        $twilioWhatsAppNumber = config('services.twilio.from');

        // $twilioSid = config('app.twilio_sid');
        // $twilioToken = config('app.twilio_auth_token');
        // $twilioWhatsAppNumber = config('app.twilio_whatsapp_number');

        $recipientNumber = 'whatsapp:+237671586513'; // Replace with the recipient's phone number in WhatsApp format (e.g., "whatsapp:+237671586513")
        $message = "Hello from Tech Chantier WhatsApp API in Laravel! 🚀";

        $twilio = new Client($twilioSid, $twilioToken);

        try {
            $twilio->messages->create(
                $recipientNumber,
                [
                    "from" => $twilioWhatsAppNumber,
                    "body" => $message,
                ]
            );

            return response()->json(['message' => 'WhatsApp message sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
