<?php

namespace App\Livewire\Client\Program;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    #[Layout('components.layouts.client.app')]
    public function render()
    {
        return view('livewire.client.program.show');
    }
}
