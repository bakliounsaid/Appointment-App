<?php

namespace App\Livewire\Admin\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ResetPassword extends Component
{
    #[Url]
    public $token = "";
    #[Url]
    public $email = "";
    public $password = "";
    public $password_confirmation = "";

    public $status = "";


    public function resetPassword()
    {
        $this->status = "";

        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $this->status = Password::broker('admins')->reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token
            ],
            function (Admin $admin, string $password) {
                $admin->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $admin->save();

                event(new PasswordReset($admin));
            }
        );

        if ($this->status === Password::PASSWORD_RESET) {
            Alert::toast(__($this->status), 'success');
            $this->redirectRoute('admin.auth.login');
        } else {
            $this->addError('status', $this->status);
        }
    }
    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.auth.reset-password');
    }
}
