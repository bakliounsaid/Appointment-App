<?php

namespace App\Livewire\Client;

use App\Mail\Company;
use App\Models\City;
use App\Models\State;
use App\Services\HubspotContactService as ServicesHubspotContactService;
use DB;
use Http;
use HubspotContactService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Log;
use Mail;
use Throwable;

class Marketing extends Component
{
    public $fullName;
    public $city;
    public $state;
    public $locale;
    public $phone;
    public $email;
    public $description;
    public $successPage = false;

    #[Url]
    public $type;


    protected $rules = [
        'fullName'    => 'required|string|max:50',
        'phone'        => 'required|numeric|digits_between:8,15',
        'email'        => 'nullable|email',
        'state'        => 'required|exists:states,id',
        'city'         => 'required|exists:cities,id',
        'description'  => 'nullable|string|max:500',
        'type'         => 'nullable|string|max:50',
    ];

    public function mount()

    {
        $this->locale = app()->getLocale();
    }
    #[Computed]

    public function cities()
    {
        return $this->state ? State::find($this->state)
            ->cities()
            ->select('id', "{$this->locale}_name")
            ->get()
            : [];
    }

    #[Computed]
    public function states()
    {
        return State::select("id", "{$this->locale}_name")->get();
    }

    public function save()
    {
        if (in_array($this->type, ['fair', 'transport', 'ads'])) {

            $this->validate();
            try {
                $response = app(ServicesHubspotContactService::class)->createContact([
                    'email' => $this->email ?: null,
                    'lastname' => $this->fullName,
                    'phone' => $this->phone,
                    'message' => $this->description ?: null,
                    'wilaya' => State::find($this->state)->fr_name,
                    'commune' => City::find($this->city)->fr_name,
                    'type' => $this->type,
                    'hs_lead_status' => 'NEW',
                ]);
                if ($response->failed()) {
                    $this->dispatch('show-toast-alert', [
                        "text" => __('Already registered!'),
                        'icon' => "warning"
                    ]);
                } else {
                    if (!empty($this->email)) {
                        Mail::to($this->email)->send(new Company($this->fullName));
                    }
                    $this->dispatch('show-toast-alert', [
                        "text" => __('You have been registered!'),
                        'icon' => "success"
                    ]);
                    $this->successPage = true;
                }
            } catch (Throwable $th) {
                Log::alert($th->getMessage());
                $this->dispatch('show-toast-alert', [
                    "text" => __('Could not register try again!'),
                    'icon' => "warning"
                ]);
            }
        } else {
            $this->dispatch('show-toast-alert', [
                "text" => __('Please try again!'),
                'icon' => "warning"
            ]);
        }
    }
    #[Layout('components.layouts.client.app')]
    public function render()
    {
        return view('livewire.client.marketing');
    }
}
