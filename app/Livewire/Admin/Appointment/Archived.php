<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Archived extends Component
{
    use WithPagination;
    public $paginate = 10;
    public $search = "";
    public $language;

    public function  mount()
    {
      $this->language = app()->getLocale();
    }
    #[Computed]
    public function Archived()
    {
        return Appointment::orderByDesc('id')->whereHas('latestStatus', function ($query) {
            $query->whereHas('status', function ($query) {
                $query->where('name', 'Archived');
            });
        })->when(trim($this->search) != "", function ($query) {
            $query->search(trim($this->search));
        });
    }
    #[On('delete')]
    public function delete($id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->delete();

            $this->dispatch('show-toast-alert', [
                "text" => __('Appointment deleted successfully!'),
                'icon' => "success"
            ]);
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not delete this Appointment!'),
                'icon' => "warning"
            ]);
        }
    }

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.appointment.archived')->with([
            'archived' => $this->archived->paginate($this->paginate)
        ]);
    }
}
