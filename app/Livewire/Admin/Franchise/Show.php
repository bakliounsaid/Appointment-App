<?php

namespace App\Livewire\Admin\Franchise;

use App\Models\Country;
use App\Models\Franchise;
use App\Models\FranchiseAdmin;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Throwable;

class Show extends Component
{
    use WithFileUploads;

    public  Franchise $franchise;
    public  FranchiseAdmin $admin;
    public $lang;
    public $langColumn;
    public $selectedCountryOne;
    public $selectedCountryTwo;
    public $username;
    public $email;
    public $firstname;
    public $lastname;
    public $password ;
    public $password_confirmation;
    public $image;

    public function rules()
    {
        return [
            'image' => 'nullable|image|mimetypes:image/jpeg,image/png,image/bmp,image/webp,image/svg+xml|max:2048',
            'franchise.name' => 'required|string|max:255',
            'franchise.email' => ['required', 'email', Rule::unique('franchises', 'email')->whereNull('deleted_at')->ignore($this->franchise->id)],
            'franchise.phone1' => ['required', 'numeric', Rule::unique('franchises', 'phone1')->whereNull('deleted_at')->ignore($this->franchise->id)],
            'franchise.phone2' => ['nullable', 'numeric','different:phone1', Rule::unique('franchises', 'phone2')->whereNull('deleted_at')->ignore($this->franchise->id)],
            'franchise.facebook' => 'nullable|url',
            'franchise.instagram' => 'nullable|url',
            'franchise.youtube' => 'nullable|url',
            'franchise.twitter' => 'nullable|url',
            'username' =>  ['required', 'string','min:3', Rule::unique('franchise_admins', 'username')->whereNull('deleted_at')->ignore($this->admin->id)],
            'email' =>  ['required', 'email', Rule::unique('franchise_admins', 'email')->whereNull('deleted_at')->ignore($this->admin->id)],
            'firstname' => 'nullable|string|min:3',
            'lastname' => 'nullable|string|min:3',
            'password' => 'nullable|min:8|confirmed',
        ];
    }
    public function mount()
    {
        $this->lang = App::currentLocale();
        $this->langColumn = $this->lang . '_name';
        $this->admin = $this->franchise->franchiseAdmins->first();
        $this->username = $this->admin->username;
        $this->email = $this->admin->email;
        $this->firstname = $this->admin->firstname;
        $this->lastname = $this->admin->lastname;
        $this->selectedCountryOne = Country::where('phone_code', $this->franchise->phone_code1)->first();
        $this->selectedCountryTwo = $this->franchise->phone_code2 ? Country::where('phone_code', $this->franchise->phone_code2)->first() : $this->countries->where('code', 'DZ')->first();
    }

    public function selectCountry($countryId, $type)
    {
        $country = $this->countries->find($countryId);
        if ($country)
            $type == 'One' ? $this->selectedCountryOne = $country : $this->selectedCountryTwo = $country;
    }

    #[Computed]
    public function countries()
    {
        return Country::select('id', 'code', 'phone_code', "{$this->langColumn} as name")
            ->orderByRaw("code = 'DZ' DESC")
            ->orderBy('name', 'asc')
            ->get();
    }

    public function edit()
    {
        $this->validate();
        try {
            DB::transaction(function () {
                if ($this->image) {
                    Storage::delete($this->franchise->logo);
                    $manager = ImageManager::gd();
                    $readImage = $manager->read($this->image);
                    $encoded = $readImage->scale(600, 600)->encode(new WebpEncoder());
                    if (Storage::put('franchises/' . md5($this->image) . '.webp', $encoded->__toString())) {
                        $this->franchise->logo = 'franchises/' . md5($this->image) . '.webp';
                    }
                }
                $this->franchise->phone_code1 = $this->selectedCountryOne->phone_code;
                $this->franchise->phone_code2 =  $this->franchise->phone2 ? $this->selectedCountryTwo->phone_code : null;
                $this->franchise->save();
                $this->admin->email = $this->email;
                $this->admin->username = $this->username;
                $this->admin->lastname = $this->lastname;
                $this->admin->firstname = $this->firstname;
                if ($this->password)
                $this->admin->password = Hash::make($this->password);
                $this->admin->save();
                alert()->success(__('Updated successfully'), __('Franchise updated successfully'));
                $this->redirectRoute('admin.franchises.index');
            });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "title" => __('Failed update'),
                "text" => __('Could not update this franchise'),
                'icon' => "warning"
            ]);
        }
    }


    public function updated($property)
    {
        try {
            $this->validateOnly($property);
        } catch (ValidationException $ve) {
            if ($property == 'image')
                $this->reset('image');
            throw $ve;
        }
    }


    #[Layout('components.layouts.admin.app')]

    public function render()
    {
        return view('livewire.admin.franchise.show');
    }
}
