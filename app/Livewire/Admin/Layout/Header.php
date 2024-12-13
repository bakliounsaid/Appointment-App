<?php

namespace App\Livewire\Admin\Layout;

use App\Models\Admin;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header extends Component
{
    public Admin $admin;

    public function mount()
    {
        $this->admin = Auth::guard('admin')->user();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('admin.auth.login');
    }

    public function setLocale($locale)
    {
        Session::put('locale', $locale);
        App::setLocale($locale);

        return $this->redirect(url()->previous());
    }
    public function render()
    {
        return view('components.layouts.admin.header');
    }
}
