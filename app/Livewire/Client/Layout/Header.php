<?php

namespace App\Livewire\Client\Layout;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header extends Component
{
    public $language;

    public function mount()
    {
        $this->language = App::currentLocale();
    }
    public function toggleLanguage()
    {
        $this->language = $this->language === 'fr' ? 'ar' : 'fr';
        Session::put('locale', $this->language);
        App::setLocale($this->language);

        return $this->redirect(url()->previous());
    }

    public function render()
    {
        return view('components.layouts.client.header');
    }
}
