<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Pending extends Component
{

    use WithPagination;
    public $paginate = 10;
    public $search = "";


    #[Computed]
    public function pending()
    {
        return Appointment::whereHas('statuses', function ($query) {
            $query->where('name', 'Pending');
        })->when(trim($this->search) != "", function ($query) {
            $query->search(trim($this->search));
        });
    }

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.appointment.pending')>with([
            'pending' => $this->pending->paginate($this->paginate)
        ]);;
    }
}
