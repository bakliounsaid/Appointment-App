<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

class Detail extends Component
{
    public Appointment $appointment;
    public $city;
    public $state;
    public $adminDate;
    public $confirmed;
    public $archived;
    public function mount()
    {
        $currentLocale = app()->getLocale();
        $this->city = $this->appointment->city->{$currentLocale . '_name'};
        $this->state = $this->appointment->city->state->{$currentLocale . '_name'};
        $this->adminDate = $this->appointment->admin_date ? Carbon::parse($this->appointment->admin_date)->format('Y-m-d'): null;
        $this->confirmed = Status::where('name', 'Validated')->first();
        $this->archived = Status::where('name', 'Archived')->first();
        $this->appointment->seen = true;
        $this->appointment->save();
    }
    public function confirme()
    {
        $this->validate(['adminDate' => 'required|date|after_or_equal:' . Carbon::now()->toDateString(),]);
        try {
            DB::transaction(function () {
                if ($this->appointment->latestStatus->status->name == "Pending" && $this->existingAppiontment > 3) {
                    $this->dispatch('showAlert', [
                        "text" => __('Could make more then foor appointments in same day!'),
                        'icon' => "warning"
                    ]);


                }
                else
                {
                if($this->appointment->latestStatus->status->name == "Pending")
                {
                 $this->appointment->statuses()->attach($this->confirmed->id);
                }
                $this->appointment->admin_date = $this->adminDate;
                $this->appointment->save();
                alert()->success(__('Validated successfully'), __('Appointment validated successfully'));
                return redirect()->route('admin.appointments.validated');
              }
            });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "text" => __('Could not validate this appointment!'),
                'icon' => "warning"
            ]);
        }
    }
    public function archive()
    {
        try {
            DB::transaction(function () {
                if ($this->appointment->latestStatus->status->name == "Validated" && $this->appointment->admin_date < now()) {
                    $this->appointment->statuses()->attach($this->archived->id);
                    alert()->success(__('Archived successfully'), __('Appointment archived successfully'));
                    return redirect()->route('admin.appointments.archived');
                }
            });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "text" => __('Could not archive this appointment!'),
                'icon' => "warning"
            ]);
        }
    }
    #[Computed]
    public function existingAppiontment()
    {
        return Appointment::where('admin_date', $this->adminDate)->whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Validated');
            });
        })->count();
    }
    #[Layout('components.layouts.admin.app')]

    public function render()
    {
        return view('livewire.admin.appointment.detail');
    }
}
