<?php

namespace App\Livewire\Admin\Appointment;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Validated extends Component
{

    use WithPagination;
    public $paginate = 10;
    public $search = "";

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.appointment.validated');
    }
}
