<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends BaseResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Ponastavitev gesla')
            ->greeting('Pozdravljeni!' . ' '  . $notifiable->name . ',')
            ->line('To e-pošto ste prejeli, ker smo prejeli zahtevo za ponastavitev gesla za vaš račun.')
            ->action('Ponastavitev gesla', url(route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false)))
            ->line('Ta povezava za ponastavitev gesla bo potekla čez 60 minut.', [
                'count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')
            ])
            ->line('Če niste zahtevali ponastavitve gesla, ignorirajte to sporočilo.');
    }
}