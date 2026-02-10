<?php

namespace App\Livewire\Admin\Layout;

use App\Models\Appointment;
use App\Models\Order;
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
        #[Computed()]
    public function confirmed()
    {
        return Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Validated');
            });
        })->count();
    }
    #[Computed()]
        public function ongoing()
    {
        return Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Ongoing');
            });
        })->count();
    }
       #[Computed()]
        public function archived()
    {
        return Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Archived');
            });
        })->count();
    }
    #[Computed()]
    public function orders()
    {
        return  Order::whereHas('latestStatus', function ($query) {
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
