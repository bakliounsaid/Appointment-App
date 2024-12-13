<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.index');
    }
}
