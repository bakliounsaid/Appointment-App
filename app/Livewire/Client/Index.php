<?php

namespace App\Livewire\Client;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('components.layouts.client.app')]
    public function render()
    {
        return view('livewire.client.index');
    }
}
