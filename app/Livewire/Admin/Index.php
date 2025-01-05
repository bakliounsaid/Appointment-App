<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Computed()]
    public function validated()
    {
        return Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Validated');
            });
        })->count();
    }
    #[Computed]
    public function Archived()
    {
        return Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Archived');
            });
        })->count();
    }
    #[Computed]
    public function pending()
    {
        return Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Pending');
            });
        })->count();
    }
    #[Computed]
    public function ongoing()
    {
        return Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Ongoing');
            });
        })->count();
    }
    #[Computed]
    public function monthlyQuotation()
    {
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();
        $sum = Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->whereIn('name', ['Ongoing', 'Archived']);
            });
        })->whereBetween('assembly_date', [$startOfLastMonth, $endOfLastMonth])
            ->sum('price');
        return round($sum, 2);
    }
    #[Computed]
    public function weeklyQuotation()
    {
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek()->toDateString();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek()->toDateString();
        $sum = Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->whereIn('name', ['Ongoing', 'Archived']);
            });
        })->whereBetween('assembly_date', [$startOfLastWeek, $endOfLastWeek])
            ->sum('price');
        return round($sum, 2);
    }
    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.index');
    }
}
