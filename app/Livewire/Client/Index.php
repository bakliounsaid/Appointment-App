<?php

namespace App\Livewire\Client;

use App\Mail\NewAppointment;
use App\Models\Appointment;
use App\Models\State;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

class Index extends Component
{
    public $firstname;
    public $lastname;
    public $city;
    public $state;
    public $address;
    public $location;
    public $description;
    public $phone;
    public $email;
    public $locale;
    public $date;
    public $pending;
    public $windows;
    public $successPage = false;

    protected $rules = [
        'firstname'    => 'required|string|max:50',
        'lastname'     => 'required|string|max:50',
        'phone'        => 'required|numeric|digits_between:8,15',
        'phone2'        => 'nullable|numeric|digits_between:8,15',
        'email'        => 'nullable|email',
        'state'        => 'required|exists:states,id',
        'city'         => 'required|exists:cities,id',
        'address'      => 'nullable|string|max:255',
        'location'     => 'nullable|string|max:255',
        'description'  => 'nullable|string|max:1000',
        'date' => 'required|date',
        'windows'=> 'integer|min:1'
    ];

    public function mount()
    {

        $this->locale = app()->getLocale();
        $this->pending = Status::where('name', 'Pending')->first();
    }
    #[Computed]

    public function cities()
    {
        return $this->state ?  State::find($this->state)->cities()->select('id', "{$this->locale}_name as name")->get() : [];
    }

    #[Computed]
    public function states()
    {
        return State::select("id", "{$this->locale}_name as name")->get();
    }
    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {
            $appointment = new Appointment();
            $appointment->firstname    = $this->firstname;
            $appointment->lastname     = $this->lastname;
            $appointment->phone        = $this->phone;
            $appointment->email        = $this->email;
            $appointment->localisation = $this->localisation  ?? null;
            $appointment->address      = $this->address ?? null;
            $appointment->phone2      = $this->phone2 ?? null;
            $appointment->description      = $this->description ?? null;
            $appointment->windows = $this->windows;
            $appointment->client_date  = $this->date;
            $appointment->city()->associate($this->city);
            $appointment->save();
            $appointment->statuses()->attach($this->pending->id);
            $appointment->save();
            Mail::to("Chaimarideaux@gmail.com")->send(new NewAppointment($appointment));
            $this->dispatch('show-toast-alert', [
                "text" => __('Appointment Created successfully!'),
                'icon' => "success"
            ]);
            $this->successPage = true;
           });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not create this appointment!'),
                'icon' => "warning"
            ]);
        }
    }

    #[Layout('components.layouts.client.app')]
    public function render()
    {
        return view('livewire.client.index');
    }
}
