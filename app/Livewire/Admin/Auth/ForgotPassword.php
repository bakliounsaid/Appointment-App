<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email = "";
    public $status = "";


    public function sendRestLink()
    {
        $this->status = "";

        $this->validate([
            'email' => 'required'
        ]);

        $this->status = Password::broker('admins')->sendResetLink(
            ['email' => $this->email]
        );
        if (in_array($this->status, [Password::INVALID_USER, Password::INVALID_TOKEN, Password::RESET_THROTTLED])) {
            $this->addError('status', $this->status);
        }
    }

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.auth.forgot-password');
    }
}
