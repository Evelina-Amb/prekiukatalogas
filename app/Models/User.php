<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        // Generate the custom signed URL for verification
        $verificationUrl = URL::temporarySignedRoute(
            'custom.verification', // Use your custom verification route
            Carbon::now()->addMinutes(60),
            ['id' => $this->id, 'hash' => sha1($this->getEmailForVerification())]
        );

        // Send the notification with the URL
        $this->notify(new \App\Notifications\CustomVerifyEmail($verificationUrl));
    }
}
