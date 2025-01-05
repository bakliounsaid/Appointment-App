<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public $username = '';
    public $password = '';
    public $remember = false;

    public function login()
    {
      $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            
            $credentials = [
                $this->getUsernameKey() => $this->username,
                'password' => $this->password
            ];
            if (Auth::guard('admin')->attempt($credentials, $this->remember)) {
                request()->session()->regenerate();

                return redirect()->route('admin.dashboard');
            }
            $this->addError('credentials', __('auth.failed'));
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->addError('credentials', __('An error occurred during login.'));
        }
    }

    #[Layout('components.layouts.admin.app')]

    public function render()
    {
        return view('livewire.admin.auth.login');
    }

    private function getUsernameKey()
    {
        return filter_var($this->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }
}
