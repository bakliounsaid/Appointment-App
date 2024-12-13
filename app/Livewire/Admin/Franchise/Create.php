<?php

namespace App\Livewire\Admin\Franchise;

use Livewire\Attributes\Layout;
use Livewire\Component;
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
use Livewire\WithFileUploads;
use Throwable;

class Create extends Component
{
    use WithFileUploads;

    public $selectedCountryOne;
    public $selectedCountryTwo;
    public $companyName;
    public $email;
    public $adminEmail;
    public $image;
    public $facebook;
    public $youtube;
    public $twitter;
    public $instagram;
    public $username;
    public $firstname ="";
    public $lastname = "";
    public $password = "";
    public $password_confirmation = "";
    public $phone1;
    public $phone2;
    public $lang;
    public $langColumn;

    public function rules()
    {
        return [
            'image' => 'required|image|mimetypes:image/jpeg,image/png,
            image/bmp,image/webp,image/svg+xml|max:2048',
            'companyName' => 'required|string|max:255',
            'email' =>['required', 'email', Rule::unique('franchises', 'email')->whereNull('deleted_at')],
            'phone1' =>['required', 'numeric', Rule::unique('franchises', 'phone1')->whereNull('deleted_at')],
            'phone2' => ['nullable', 'numeric', Rule::unique('franchises', 'phone2')->whereNull('deleted_at'),'different:phone1'],
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'twitter' => 'nullable|url',
            'username' =>['required','string','min:3', Rule::unique('franchise_admins', 'username')->whereNull('deleted_at')],
            'adminEmail' =>['required', 'email', Rule::unique('franchise_admins', 'email')->whereNull('deleted_at')],
            'firstname' => 'nullable|string|min:3',
            'lastname' => 'nullable|string|min:3',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function mount()
    {
        $this->lang = App::currentLocale();
        $this->langColumn = $this->lang . '_name';
        $dzCountry = $this->countries->where('code', 'DZ')->first();
        $this->selectedCountryOne = $dzCountry;
        $this->selectedCountryTwo = $dzCountry;
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


    public function save()
    {

        $this->validate();
        try {
            DB::transaction(function () {


                if ($this->image) {

                    $manager = ImageManager::gd();
                    $readImage = $manager->read($this->image);
                    $encoded = $readImage->scale(600, 600)->encode(new WebpEncoder());
                    if (Storage::put('franchises/' . md5($this->image) . '.webp', $encoded->__toString())) {
                        $logo = 'franchises/' . md5($this->image) . '.webp';
                    }
                }
                $franchise = Franchise::create([
                    'logo' => $logo,
                    'name' => $this->companyName,
                    'email' => $this->email,
                    'phone1' => $this->phone1,
                    'phone2' => $this->phone2,
                    'phone_code1' => $this->selectedCountryOne->phone_code,
                    'phone_code2' =>  $this->phone2 ? $this->selectedCountryTwo->phone_code : null,
                    'facebook' => $this->facebook,
                    'instagram' => $this->instagram,
                    'youtube' => $this->youtube,
                    "twitter" => $this->twitter
                ]);
                $admin = new FranchiseAdmin();
                $admin->franchise()->associate($franchise);
                $admin->username = $this->username;
                $admin->firstname = $this->firstname;
                $admin->lastname = $this->lastname;
                $admin->email = $this->adminEmail;
                $admin->password = Hash::make($this->password);
                $admin->save();
                alert()->success(__('Created successfully'),__('Franchise created successfully'));
                $this->redirectRoute('admin.franchises.index');
            });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "title" => __('Failed creation'),
                "text" => __('Could not create this franchise'),
                'icon' => "warning"
            ]);
        }
    }


    public function updated($property)
    {
        try {
            $this->validateOnly($property);
        } catch(ValidationException $ve) {
            if($property == 'image')
                $this->reset('image');
            throw $ve;
        }
    }


    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.franchise.create');
    }
}
