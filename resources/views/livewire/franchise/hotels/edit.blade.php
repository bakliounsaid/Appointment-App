<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            {{ Breadcrumbs::render('franchise.hotels.edit', $hotel) }}
        </div>
        <form wire:submit.prevent="edit" class="needs-validation">
            <!-- General Info Card -->
            <div class="card mb-4" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
                <div class="card-header" style="border-bottom: 1px solid #e9ecef;">
                    <h5 class="card-title mb-0">{{ __('Hotel Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="logo-wrapper" id="logoWrapper">
                            <span  class="form-label d-block ">{{ __('Hotel pictures') }}</span>
                            <label for="logo" class="upload-btn cursor-pointer">
                                {{ __('Select Hotel pictures') }}
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
                                    <div class="file-info">
                                        <span class="file-name" id="fileName">
                                            {{ $image->getClientOriginalName() }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="hotelName"
                                class="form-label ">{{ __('Hotel Name') }}</label>
                            <input type="text" class="form-control @error('hotelName') is-invalid @enderror"
                                id="hotelName" wire:model.defer="hotelName" placeholder="{{ __('Hotel Name') }}">
                            @error('hotelName')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="chainName"
                                class="form-label ">{{ __('Chain name') }}</label>
                            <input type="text" class="form-control @error('chainName') is-invalid @enderror"
                                id="chainName" wire:model.defer="chainName" placeholder="{{ __('Chain name') }}">
                            @error('chainName')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="email"
                                class="form-label ">{{ __('Hotel Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" wire:model.defer="email" placeholder="{{ __('Hotel Email') }}">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="hotelName"
                                class="form-label ">{{ __('Adress one') }}</label>
                            <input type="text" class="form-control @error('addressOne') is-invalid @enderror"
                                id="Adress one" wire:model.defer="addressOne" placeholder="{{ __('Adress one') }}">
                            @error('addressOne')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="hotelName"
                                class="form-label ">{{ __('Adress two') }}</label>
                            <input type="text" class="form-control @error('addressTwo') is-invalid @enderror"
                                id="hotelName" wire:model.defer="addressTwo" placeholder="{{ __('Adress two') }}">
                            @error('addressTwo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="postal-code"
                                class="form-label ">{{ __('Postal Code') }}</label>
                            <input type="text" class="form-control @error('codePostal') is-invalid @enderror"
                                id="postal-code" wire:model.defer="codePostal" placeholder="{{ __('Postal Code') }}">
                            @error('codePostal')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="country" class="form-label">{{ __('Select Country') }}</label>
                            <select wire:model.live="selectedCountry" id="country" class="form-select">
                                @if (!$selectedCountry)
                                    <option value="">{{ $defaultCountry->{$lang . '_name'} }}</option>
                                @endif
                                @foreach ($this->countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">{{ __('Select State') }}</label>
                            <select wire:model.live="selectedState" id="state" class="form-select">
                                @if (!$selectedState)
                                    <option value="">{{ $defaultState->{$lang . '_name'} }}</option>
                                @endif
                                @foreach ($this->states as $state)
                                    <option value="{{ $state->id }}">{{ $state->{$lang . '_name'} }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="city" class="form-label">{{ __('Select City') }}</label>
                            <select wire:model.live="selectedCity" id="city" class="form-select">
                                @if (!$selectedCity)
                                    <option value="">{{ $defaultCity->{$lang . '_name'} }}</option>
                                @endif
                                @foreach ($this->cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->{$lang . '_name'} }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="phone-input-container col-md-6 position-relative">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Phone') }} 1 </label>
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
                                <label class="form-label">{{ __('Phone') }} 2 </label>
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
                            <label for="amenities" class="form-label ">
                                {{ __('Amenities') }}
                            </label>
                            <textarea wire:model.defer='amenities' placeholder="{{ __('Enter available amenities') }}" class="form-control"
                                id="amenities"></textarea>
                            @error('amenities')
                                <span class="invalid-feedback position-absolute bottom-0">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="description" class="form-label ">
                                {{ __('Description') }}
                            </label>
                            <textarea class="form-control plaintext" wire:model.defer='description'>
                                </textarea>
                            @error('description')
                                <span class="invalid-feedback position-absolute bottom-0">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-end pt-3">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                            <span wire:loading wire:target="edit" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
        @livewire('franchise.hotels.room.index', ['hotel' => $hotel])

    </div>
</main>
<script>
    document.querySelectorAll('.country-option').forEach((option, idx) => {
        option.addEventListener('click', () => {
            const phoneInputContainer = option.closest('.phone-input-container');
            const phoneInput = phoneInputContainer.querySelector('input[type="tel"]');
            if (phoneInput) {
                phoneInput.focus();
            }
        });
    });
    document.addEventListener('livewire:load', function() {
        const logoInput = document.getElementById('logo');

        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
        });
    });
</script>
