<?php

namespace App\Livewire\Admin\Layout;

use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{

    #[On('new-appointment')]
    public function updateAppointmentList()
    {
      return true;
    }
    #[Computed()]
    public function pending()
    {
        return Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Pending');
            });
        })->count();
    }
    public function render()
    {
        return view('components.layouts.admin.sidebar');
    }
}
