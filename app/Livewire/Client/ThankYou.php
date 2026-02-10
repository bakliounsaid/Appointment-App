<?php

namespace App\Livewire\Client;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ThankYou extends Component
{
     #[Layout('components.layouts.client.app')]
    public function render()
    {
        return view('livewire.client.thank-you');
    }
}
