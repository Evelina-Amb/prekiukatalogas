<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendAdminNewUserNotification
{
    public function handle(Verified $event)
    {
        $user = $event->user;

        Mail::raw("Naujas verfikuotas vartotojas:\n\nVardas: {$user->name}\nEmail: {$user->email}", function ($message) {
            $message->to('forgamesandstuf0001@gmail.com')
                    ->subject('Naujas verifikuotas vartotojas');
        });
    }
}
