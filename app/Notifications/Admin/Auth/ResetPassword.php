<?php

namespace App\Notifications\Admin\Auth;

use Illuminate\Auth\Notifications\ResetPassword as  ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
{

    /**
     * Get the reset URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        return url(route('admin.auth.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}
