<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('New Franchise') }}</h1>
        </div>
        <form wire:submit.prevent="save" class="needs-validation">
            <!-- General Info Card -->
            <div style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);" class="card mb-4">
                <div style="border-bottom: 1px solid #e9ecef;" class="card-header">
                    <h5 class="card-title mb-0">{{ __('Franchise Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="logo-wrapper" id="logoWrapper">
                            <span class="form-label d-block ">{{ __('Franchise Logo') }}</span>
                            <label for="logo" class="upload-btn cursor-pointer">
                                {{ __('Select Franchise Logo') }}
                            </label>
                            <input type="file" id="logo" wire:model="image"
                                class="d-none @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            <div class="logo-preview-container gap-3 mt-3 overflow-hidden {{ $image ? 'show' : '' }}"
                                id="previewContainer">
                                @if ($image)
                                    <img id="logoPreview" class="logo-preview bg-white" alt="Logo preview"
                                        src="{{ $image->temporaryUrl() }}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="companyName" class="form-label">{{ __('Franchise Name') }}</label>
                            <input type="text" class="form-control @error('companyName') is-invalid @enderror"
                                id="companyName" wire:model.defer="companyName"
                                placeholder="{{ __('Franchise Name') }}">
                            @error('companyName')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('Franchise Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" wire:model.defer="email" placeholder="{{ __('Franchise Email') }}">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="phone-input-container col-md-6 position-relative">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Phone number 1') }} </label>
                                <div class="unified-input-group">
                                    <div class="">
                                        <button class="country-select" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <img src="{{ asset('vendor/blade-flags/country-' . strtolower($selectedCountryOne->code ?? 'default') . '.svg') }}"
                                                alt="{{ $selectedCountryOne->name ?? 'Country flag' }}">
                                        </button>
                                        <ul class="dropdown-menu country-dropdown">
                                            @foreach ($this->countries as $country)
                                                <li tabindex="0">
                                                    <label
                                                        class="{{ $country->id === $selectedCountryOne->id ? 'active' : '' }} cursor-pointer dropdown-item country-option"
                                                        wire:click="selectCountry({{ $country->id }},'One')">
                                                        <img src="{{ asset('vendor/blade-flags/country-' . strtolower($country->code) . '.svg') }}"
                                                            alt="{{ $country->name }} flag">
                                                        <span>{{ $country->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <span class="country-code">+{{ $selectedCountryOne->phone_code ?? '' }}</span>
                                    <input type="tel" class="phone-number @error('phone1') is-invalid @enderror"
                                        wire:model.defer='phone1' placeholder="{{ __('Enter phone number') }}">
                                    @error('phone1')
                                        <span
                                            class="invalid-feedback position-absolute bottom-0">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="phone-input-container position-relative col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Phone number 2') }} </label>
                                <div class="unified-input-group">
                                    <div class="">
                                        <button class="country-select" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <img src="{{ asset('vendor/blade-flags/country-' . strtolower($selectedCountryTwo->code ?? 'default') . '.svg') }}"
                                                alt="{{ $selectedCountryTwo->name ?? 'Country flag' }}">
                                        </button>
                                        <ul class="dropdown-menu country-dropdown">
                                            @foreach ($this->countries as $country)
                                                <li>
                                                    <label
                                                        class="{{ $country->id === $selectedCountryTwo->id ? 'active' : '' }} cursor-pointer dropdown-item country-option"
                                                        wire:click="selectCountry({{ $country->id }},'Two')">
                                                        <img src="{{ asset('vendor/blade-flags/country-' . strtolower($country->code) . '.svg') }}"
                                                            alt="{{ $country->name }} flag">
                                                        <span>{{ $country->name }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <span class="country-code">+{{ $selectedCountryTwo->phone_code ?? '' }}</span>
                                    <input type="tel" class="phone-number @error('phone2') is-invalid @enderror"
                                        wire:model.defer='phone2' placeholder="{{ __('Enter phone number') }}">
                                    @error('phone2')
                                        <span
                                            class="invalid-feedback position-absolute bottom-0">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="facebook" class="form-label ">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    width="24" height="24">
                                    <path
                                        d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                                </svg>
                                {{ __('Facebook Link') }}
                            </label>
                            <input type="url" class="form-control @error('facebook') is-invalid @enderror"
                                id="facebook" wire:model.defer="facebook"
                                placeholder="{{ __('Enter Facebook URL') }}">
                            @error('facebook')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="Youtube" class="form-label ">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                    width="24" height="24">
                                    <path
                                        d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                                </svg>

                                {{ __('Youtube Link') }}
                            </label>
                            <input type="url" class="form-control @error('youtube') is-invalid @enderror"
                                id="youtube" wire:model.defer="youtube"
                                placeholder="{{ __('Enter Youtube URL') }}">
                            @error('youtube')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="Instagram" class="form-label ">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    width="24" height="24">
                                    <path
                                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                </svg>
                                {{ __('Instagram Link') }}
                            </label>
                            <input type="url" class="form-control @error('instagram') is-invalid @enderror"
                                id="instagram" wire:model.defer="instagram"
                                placeholder="{{ __('Enter Instagram URL') }}">
                            @error('instagram')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="Twitter" class="form-label ">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    width="24" height="24">
                                    <path
                                        d="M459.4 151.7c.3 4.5 .3 9.1 .3 13.6 0 138.7-105.6 298.6-298.6 298.6-59.5 0-114.7-17.2-161.1-47.1 8.4 1 16.6 1.3 25.3 1.3 49.1 0 94.2-16.6 130.3-44.8-46.1-1-84.8-31.2-98.1-72.8 6.5 1 13 1.6 19.8 1.6 9.4 0 18.8-1.3 27.6-3.6-48.1-9.7-84.1-52-84.1-103v-1.3c14 7.8 30.2 12.7 47.4 13.3-28.3-18.8-46.8-51-46.8-87.4 0-19.5 5.2-37.4 14.3-53 51.7 63.7 129.3 105.3 216.4 109.8-1.6-7.8-2.6-15.9-2.6-24 0-57.8 46.8-104.9 104.9-104.9 30.2 0 57.5 12.7 76.7 33.1 23.7-4.5 46.5-13.3 66.6-25.3-7.8 24.4-24.4 44.8-46.1 57.8 21.1-2.3 41.6-8.1 60.4-16.2-14.3 20.8-32.2 39.3-52.6 54.3z" />
                                </svg>
                                {{ __('Twitter Link') }}
                            </label>
                            <input type="url" class="form-control @error('twitter') is-invalid @enderror"
                                id="twitter" wire:model.defer="twitter"
                                placeholder="{{ __('Enter Twitter URL') }}">
                            @error('twitter')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div style="border-bottom: 1px solid #e9ecef;" class="card-header">
                            <h5 class="card-title mb-0">{{ __('Admin Information') }}</h5>
                        </div>


                        <div class="col-md-6">
                            <label for="username" class="form-label">{{ __('Username') }}</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username"wire:model.defer="username" placeholder="{{ __('Username') }}">
                            @error('username')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="adminEmail" class="form-label">{{ __('Admin Email') }}</label>
                            <input type="email" class="form-control @error('adminEmail') is-invalid @enderror"
                                id="adminEmail" wire:model.defer="adminEmail" placeholder="{{ __('Admin Email') }}">
                            @error('adminEmail')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">{{ __('First Name') }}</label>
                            <input type="text" class="form-control @error('firstanme') is-invalid @enderror"
                                id="firstName" wire:model.defer="firstname" placeholder="{{ __('First Name') }}">
                            @error('firstname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                id="lastName" wire:model.defer="lastname" placeholder="{{ __('Last Name') }}">
                            @error('lastname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input type="password" wire:model.defer ="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="{{ __('Password') }}">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                wire:model.defer="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                        </div>
                    </div>
                    <div style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);" class="card mb-4">
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-lg px-5">
                        <span wire:loading wire:target="save" class="spinner-border spinner-border-sm" role="status"
                            aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener('livewire:load', function() {
        const logoInput = document.getElementById('logo');

        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
        });
    });
    document.querySelectorAll('.country-option').forEach((option, idx) => {
        option.addEventListener('click', () => {
            const phoneInputContainer = option.closest('.phone-input-container');
            const phoneInput = phoneInputContainer.querySelector('input[type="tel"]');
            if (phoneInput) {
                phoneInput.focus();
            }
        });
    });
</script>
