<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class OngoingCalendar extends Component
{
    public  $nextSevenDays = [];
    public $language;

    public function mount()
    {
        $this->language = app()->getLocale();
        Carbon::setLocale( $this->language);
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->addDays($i);
            $this->nextSevenDays[] = [
                'date' => $date->toDateString(),
                'day' => $date->translatedFormat('l'),
            ];
        }
    }
    #[Computed]
    public function ongoing()
    {
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->addDays(7)->endOfDay();

        $ongoing = Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Ongoing');
            });
        })
            ->whereBetween('assembly_date', [$startDate, $endDate])
            ->get();

        $appointmentsByDay = [];

        foreach ($this->nextSevenDays as $day) {
            $appointmentsByDay[$day['date']] = $this->getAppointmentsForDay($day['date']);
        }

        return $appointmentsByDay;
    }
    private function getAppointmentsForDay($date)
    {
        $ongoing = Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Ongoing');
            });
        })
            ->whereBetween('assembly_date', [$this->getStartOfDay($date), $this->getEndOfDay($date)])
            ->get();

        return $ongoing->filter(function ($appointment) use ($date) {
            return $this->isDateMatching($appointment->assembly_date, $date);
        })->values();
    }
    private function isDateMatching($assemblyDate, $targetDate)
    {
        try {
            $assemblyDateCarbon = Carbon::parse($assemblyDate)->toDateString();
            return $assemblyDateCarbon === $targetDate;
        } catch (\Exception $e) {
            Log::error('Invalid date format for assembly_date: ' . $assemblyDate, [
                'exception' => $e->getMessage(),
                'appointment' => $assemblyDate
            ]);
            return false;
        }
    }
    private function getStartOfDay($date)
    {
        return Carbon::parse($date)->startOfDay()->toDateTimeString();
    }

    private function getEndOfDay($date)
    {
        return Carbon::parse($date)->endOfDay()->toDateTimeString();
    }
    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.appointment.ongoing-calendar');
    }
}
