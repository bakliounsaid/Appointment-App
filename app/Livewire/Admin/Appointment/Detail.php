<?php

namespace App\Livewire\Admin\Appointment;

use App\Mail\AppointmentNotification;
use App\Mail\AssemblyNotification;
use App\Models\Appointment;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
    public $assemblyDate;
    public $confirmed;
    public $archived;
    public $ongoing;
    public function mount()
    {
        $currentLocale = app()->getLocale();
        $this->city = $this->appointment->city->{$currentLocale . '_name'};
        $this->state = $this->appointment->city->state->{$currentLocale . '_name'};
        $this->adminDate = $this->appointment->admin_date ? Carbon::parse($this->appointment->admin_date)->format('Y-m-d') : null;
        $this->assemblyDate = $this->appointment->assembly_date ? Carbon::parse($this->appointment->assembly_date)->format('Y-m-d') : null;
        $this->confirmed = Status::where('name', 'Validated')->first();
        $this->archived = Status::where('name', 'Archived')->first();
        $this->ongoing =  Status::where('name', 'Ongoing')->first();
        $this->appointment->seen = true;
        $this->appointment->save();
    }
    public function confirme()
    {
        $this->validate(['adminDate' => 'required|date|after_or_equal:' . Carbon::now()->toDateString()]);
        try {
            DB::transaction(function () {
                if ($this->appointment->latestStatus->status->name == "Pending" && $this->existingAppiontment > 3) {
                    $this->dispatch('showAlert', [
                        "text" => __('Could not make more then foor appointments in same day!'),
                        'icon' => "warning"
                    ]);
                } else {
                    if ($this->appointment->latestStatus->status->name == "Pending") {
                        $this->appointment->statuses()->attach($this->confirmed->id);
                    }
                    if (!$this->appointment->admin_date || ($this->appointment->admin_date && ($this->appointment->admin_date != $this->adminDate))) {
                        $this->appointment->admin_date = $this->adminDate;
                        $this->appointment->save();
                        if ($this->appointment->email)
                            Mail::to($this->appointment->email)->send(new AppointmentNotification($this->appointment));
                    }
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
                if ($this->appointment->latestStatus->status->name == "Ongoing" && $this->appointment->assembly_date < now()) {
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
    public function assembly()
    {
        try {
            $this->appointment->statuses()->attach($this->ongoing->id);
            $this->appointment->save();
            alert()->success(__('Assembly successfully'), __('Assembly confirmed successfully'));
            return redirect()->route('admin.appointments.ongoing');
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "text" => __('Could not confirmed  this appointment!'),
                'icon' => "warning"
            ]);
        }
    }
    public function dateAssembly()
    {
        $this->validate(['assemblyDate' => 'required|date|after_or_equal:' . Carbon::now()->toDateString()]);
        try {
            DB::transaction(function () {
                if ($this->appointment->latestStatus->status->name == "Ongoing" && $this->existingAssembly > 3) {
                    $this->dispatch('showAlert', [
                        "text" => __('Could not make more then foor assembly in same day!'),
                        'icon' => "warning"
                    ]);
                } else {
                    if (!$this->appointment->assembly_date || ($this->appointment->assembly_date && ($this->appointment->assembly_date != $this->assemblyDate))) {
                        $this->appointment->assembly_date = $this->assemblyDate;
                        $this->appointment->save();
                        Mail::to($this->appointment->email)->send(new AssemblyNotification($this->appointment));
                    }
                    alert()->success(__('Assembly successfully'), __('Assembly date confirmed successfully'));
                    return redirect()->route('admin.appointments.ongoing');
                }
            });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "text" => __('Could not confirmed  this appointment!'),
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
    #[Computed]
    public function existingAssembly()
    {
        return Appointment::where('assembly_date', $this->assemblyDate)->whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Ongoing');
            });
        })->count();
    }
    #[Layout('components.layouts.admin.app')]

    public function render()
    {

        return view('livewire.admin.appointment.detail');
    }
}
