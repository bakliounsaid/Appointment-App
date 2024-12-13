<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            {{ Breadcrumbs::render('agency.bookings.create') }}
        </div>
        <form wire:submit.prevent="save" class="needs-validation">
            <div style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);" class="card mb-4">
                <div style="border-bottom: 1px solid #e9ecef;" class="card-header">
                    <h5 class="card-title mb-0">{{ __($this->steps[$currentStep]) }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @if ($this->steps[$currentStep] == 'ClientInfo')
                            <div class="col-12">
                                <input class="form-check-input" type="checkbox" id="hasAccount"
                                    wire:model.live="hasAccount">
                                <label class="form-check-label fw-bold mx-2"
                                    for="hasAccount">{{ __('Client Already Has An Account') }}</label>
                            </div>
                            @if (!$this->hasAccount)
                                <div class="col-md-4">
                                    <label for="firstName" class="form-label">{{ __('First Name') }}</label>
                                    <input type="text"
                                        class="form-control @error('client.firstname') is-invalid @enderror"
                                        id="firstName" wire:model.defer="client.firstname"
                                        placeholder="{{ __('First Name') }}">
                                    @error('client.firstname')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                                    <input type="text"
                                        class="form-control @error('client.lastname') is-invalid @enderror"
                                        id="lastName" wire:model.defer="client.lastname"
                                        placeholder="{{ __('Last Name') }}">
                                    @error('client.lastname')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input type="email"
                                        class="form-control @error('client.email') is-invalid @enderror" id="email"
                                        wire:model.defer="client.email" placeholder="{{ __('Email') }}">
                                    @error('client.email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="birthDate" style="font-weight: 500;"
                                        class="form-label">{{ __('Date of birth') }}</label>
                                    <input type="date"
                                        class="form-control @error('client.date_of_birth') is-invalid @enderror"
                                        id="birthDate" wire:model.defer="client.date_of_birth"
                                        placeholder="{{ __('Date of birth') }}">
                                    @error('client.date_of_birth')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="sex" class="form-label ">{{ __('Sex') }}</label>
                                    <select class="form-control @error('client.sex') is-invalid @enderror"
                                        id="sex" wire:model.defer="client.sex" placeholder="{{ __('Sex') }}">
                                        <option value="">{{ __('Select Sex') }}</option>
                                        <option value="M">{{ __('Male') }}</option>
                                        <option value="F">{{ __('Female') }}</option>
                                    </select>
                                    @error('client.sex')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="passportNumber" class="form-label">{{ __('Passport Number') }}</label>
                                    <input type="text"
                                        class="form-control @error('client.passport_number') is-invalid @enderror"
                                        id="passportNumber" wire:model.defer="client.passport_number"
                                        placeholder="{{ __('Passport Number') }}">
                                    @error('client.passport_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">{{ __('Country') }} </label>
                                    <div class="unified-input-group">
                                        <div class="w-100">
                                            <button class="country-select w-100" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                @if ($selectedCountryOption)
                                                    <img src="{{ asset('vendor/blade-flags/country-' . strtolower($selectedCountryOption->code) . '.svg') }}"
                                                        alt="{{ $selectedCountryOption->name }} flag" class="me-2"
                                                        style="width: 20px; height: 15px;">
                                                    <span class="me-auto">{{ $selectedCountryOption->name }}</span>
                                                @else
                                                    <span class="me-auto">{{ __('Select a Country') }}</span>
                                                @endif
                                            </button>
                                            <ul class="dropdown-menu country-dropdown">
                                                @foreach ($this->countries as $country)
                                                    <li tabindex="0">
                                                        <label class="cursor-pointer dropdown-item country-option"
                                                            wire:click="selectCountry({{ $country->id }},'Country')">
                                                            <img src="{{ asset('vendor/blade-flags/country-' . strtolower($country->code) . '.svg') }}"
                                                                alt="{{ $country->name }} flag">
                                                            <span>{{ $country->name }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="selectedState" class="form-label">{{ __('State') }}</label>
                                    <select id="selectedState"
                                        class="form-select @error('selectedState') is-invalid @enderror"
                                        wire:model.live="selectedState">
                                        <option value="">{{ __('Select a State') }}</option>
                                        @if (count($this->states))
                                            @foreach ($this->states as $state)
                                                <option value="{{ $state->id }}">{{ $state->{$lang . '_name'} }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('selectedState')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="selectedCity" class="form-label">{{ __('City') }}</label>
                                    <select wire:model.live="selectedCity" id="selectedCity"
                                        class="form-select @error('selectedCity') is-invalid @enderror">
                                        <option value="">{{ __('Select a City') }}</option>
                                        @if (count($this->cities))
                                            @foreach ($this->cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->{$lang . '_name'} }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('selectedCity')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="phone-input-container col-md-6 position-relative">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Phone number 1') }} </label>
                                        <div class="unified-input-group">
                                            <div class="">
                                                <button class="country-select" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                                            <span
                                                class="country-code">+{{ $selectedCountryOne->phone_code ?? '' }}</span>
                                            <input type="tel"
                                                class="phone-number @error('client.phone1') is-invalid @enderror"
                                                wire:model.defer='client.phone1'
                                                placeholder="{{ __('Enter phone number') }}">
                                            @error('client.phone1')
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
                                                <button class="country-select" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                                            <span
                                                class="country-code">+{{ $selectedCountryTwo->phone_code ?? '' }}</span>
                                            <input type="tel"
                                                class="phone-number @error('client.phone2') is-invalid @enderror"
                                                wire:model.defer='client.phone2'
                                                placeholder="{{ __('Enter phone number') }}">
                                            @error('client.phone2')
                                                <span
                                                    class="invalid-feedback position-absolute bottom-0">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Address') }}</label>
                                    <textarea class="form-control @error('client.address') is-invalid @enderror plaintext" id="address"
                                        wire:model.defer="client.address" placeholder="{{ __('Address') }}"> </textarea>
                                    @error('client.address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="specialRequirements"
                                        class="form-label ">{{ __('Special Requirements') }}</label>
                                    <textarea class="form-control @error('specialRequirements') is-invalid @enderror plaintext"
                                        wire:model.defer='specialRequirements'></textarea>
                                    @error('specialRrequirements')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Client') }}</label>
                                    <select wire:model.live="selectedClient" id="selectedClient"
                                        class="form-select @error('selectedClient') is-invalid @enderror">
                                        <option value="">{{ __('Select Client') }}</option>
                                        @if (count($this->clients))
                                            @foreach ($this->clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('selectedClient')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Program') }}</label>
                                <select wire:model.live="selectedProgram" id="selectedProgram"
                                    class="form-select @error('selectedProgram') is-invalid @enderror">
                                    <option value="">{{ __('Select Program') }}</option>
                                    @if (count($this->programs))
                                        @foreach ($this->programs as $program)
                                            <option value="{{ $program->id }}">{{ $program->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('selectedProgram')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            @if (count($this->services))
                                <div class="row my-4">
                                    <div class="card-header px-2 py-2" style="border-bottom: 1px solid #e9ecef;">
                                        <h5 class="card-title mb-0">{{ __('Services') }}</h5>
                                    </div>
                                    <p class="mb-4 mt-2">
                                        {{ __('Please choose the services you wish to include in your reservation') }}
                                    </p>
                                    <div class="row">
                                        @foreach ($this->services->chunk(2) as $typeChunk)
                                            <div class="row mb-4">
                                                @foreach ($typeChunk as $type => $values)
                                                    <div class="col-6">
                                                        <h5 class="fw-bold">{{ __($type) }}</h5>
                                                        <div class="row g-3">
                                                            @foreach ($values as $service)
                                                                <div class="form-group col-12">
                                                                    <input
                                                                        class="form-check-input @error('selectedServices.' . $type) is-invalid @enderror"
                                                                        type="radio"
                                                                        id="service_{{ $service->id }}"
                                                                        wire:model.live="selectedServices.{{ $type }}"
                                                                        value="{{ $service->id }}"
                                                                        >
                                                                    <label class="form-check-label"
                                                                        for="service_{{ $service->id }}">
                                                                        {{ $service->name }}
                                                                        (<span
                                                                            class="text-muted">{{ __('DA', ['price' => $service->price]) }}</span>)
                                                                    </label>
                                                                    @error('selectedServices.' . $type)
                                                                        <div class="invalid-feedback d-block">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @elseif ($this->steps[$currentStep] == 'RelatedInfo')
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class=" mb-3">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label for="firstName"
                                                    class="form-label">{{ __('First Name') }}</label>
                                                <input type="text"
                                                    class="form-control @error('firstname') is-invalid @enderror"
                                                    id="firstName" wire:model.defer="firstname"
                                                    placeholder="{{ __('First Name') }}">
                                                @error('firstname')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="lastName"
                                                    class="form-label">{{ __('Last Name') }}</label>
                                                <input type="text"
                                                    class="form-control @error('lastname') is-invalid @enderror"
                                                    id="lastName" wire:model.defer="lastname"
                                                    placeholder="{{ __('Last Name') }}">
                                                @error('lastname')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="sex" class="form-label ">{{ __('Sex') }}</label>
                                                <select class="form-control @error('sex') is-invalid @enderror"
                                                    id="sex" wire:model.live="sex"
                                                    placeholder="{{ __('Sex') }}">
                                                    <option value="">{{ __('Select Sex') }}</option>
                                                    <option value="M">{{ __('Male') }}</option>
                                                    <option value="F">{{ __('Female') }}</option>
                                                </select>
                                                @error('sex')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="type"
                                                    class="form-label">{{ __('Select Type') }}</label>
                                                <select wire:model.live="type" id="type"
                                                    class="form-select @error('type') is-invalid @enderror">
                                                    <option value="">{{ __('Type') }}</option>
                                                    @foreach ($this->types as $type)
                                                        <option value="{{ $type->value }}">{{ $type->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('type')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">{{ __('Country') }} </label>
                                                <div
                                                    class="unified-input-group  @error('relatedCountry') is-invalid @enderror">
                                                    <div class="w-100">
                                                        <button class="country-select w-100" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            @if ($relatedCountry)
                                                                <img src="{{ asset('vendor/blade-flags/country-' . strtolower($relatedCountry->code) . '.svg') }}"
                                                                    alt="{{ $relatedCountry->name }} flag"
                                                                    class="me-2" style="width: 20px; height: 15px;">
                                                                <span
                                                                    class="me-auto">{{ $relatedCountry->name }}</span>
                                                            @else
                                                                <span
                                                                    class="me-auto">{{ __('Select a Country') }}</span>
                                                            @endif
                                                        </button>
                                                        <ul class="dropdown-menu country-dropdown">
                                                            @foreach ($this->countries as $country)
                                                                <li tabindex="0">
                                                                    <label
                                                                        class="cursor-pointer dropdown-item country-option"
                                                                        wire:click="selectCountry({{ $country->id }},'Related')">
                                                                        <img src="{{ asset('vendor/blade-flags/country-' . strtolower($country->code) . '.svg') }}"
                                                                            alt="{{ $country->name }} flag">
                                                                        <span>{{ $country->name }}</span>
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                </div>
                                                @error('relatedCountry')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">{{ __('Age') }}</label>
                                                <input type="number"
                                                    class="form-control @error('age') is-invalid @enderror"
                                                    id="age" wire:model.defer="age"
                                                    placeholder="{{ __('age') }}">
                                                @error('age')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="passport"
                                                    class="form-label">{{ __('Passport Number') }}</label>
                                                <input type="text"
                                                    class="form-control @error('passportNumber') is-invalid @enderror"
                                                    id="passportNumber" wire:model.defer="passportNumber"
                                                    placeholder="{{ __('Passport Number') }}">
                                                @error('passportNumber')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="relatedSpecialRequirements"
                                                    class="form-label ">{{ __('Special Requirements') }}</label>
                                                <textarea class="form-control @error('relatedSpecialRequirements') is-invalid @enderror plaintext"
                                                    wire:model.defer='relatedSpecialRequirements'></textarea>
                                                @error('relatedSpecialRequirements')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                @if (count($this->relatedServices))
                                    <div class="row my-4">
                                        <div class="card-header px-2 py-2" style="border-bottom: 1px solid #e9ecef;">
                                            <h5 class="card-title mb-0">{{ __('Services') }}</h5>
                                        </div>
                                        <p class="mb-4 mt-2">
                                            {{ __('Please choose the services you wish to include in your companion reservation') }}
                                        </p>
                                        <div class="row">
                                            @foreach ($this->relatedServices->chunk(2) as $typeChunk)
                                                <div class="row mb-4">
                                                    @foreach ($typeChunk as $type => $values)
                                                        <div class="col-6">
                                                            <h5 class="fw-bold">{{ __($type) }}</h5>
                                                            <div class="row g-3">
                                                                @foreach ($values as $service)
                                                                    <div class="form-group col-12">
                                                                        <input
                                                                            class="form-check-input @error('selectedRelatedServices.' . $type) is-invalid @enderror"
                                                                            type="radio"
                                                                            id="service_{{ $service->id }}"
                                                                            wire:model="selectedRelatedServices.{{ $type }}"
                                                                            onclick="dispatchToggleEvent('{{ $type }}', {{ $service->id }})"
                                                                            value="{{ $service->id }}">
                                                                        <label class="form-check-label"
                                                                            for="service_{{ $service->id }}">
                                                                            {{ $service->name }}
                                                                            (<span
                                                                                class="text-muted">{{ __('DA', ['price' => $service->price]) }}</span>)
                                                                        </label>
                                                                        @error('selectedRelatedServices.' . $type)
                                                                            <div class="invalid-feedback d-block">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif


                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-primary" wire:click.prevent="addTraveler">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="card-header px-2 py-2" style="border-bottom: 1px solid #e9ecef;">
                                    <h5 class="card-title mb-0">{{ __('Companions List') }}</h5>
                                </div>
                                <div class="col-12">

                                    <div class="row dt-row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped no-footer dtr-inline" width="100%"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('First Name') }}</th>
                                                        <th>{{ __('Last Name') }}</th>
                                                        <th>{{ __('Type') }}</th>
                                                        <th>{{ __('Age') }}</th>
                                                        <th>{{ __('Sex') }}</th>
                                                        <th class="text-end">{{ __('Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($travelers as $index => $traveler)
                                                        <tr>
                                                            <td>{{ $traveler['firstname'] }}</td>
                                                            <td>{{ $traveler['lastname'] }}</td>
                                                            <td>{{ $traveler['type'] }}</td>
                                                            <td>{{ $traveler['age'] }}</td>
                                                            <td>{{ getSexName($traveler['sex']) }}</td>
                                                            <td class="text-end">
                                                                <button class="btn btn-primary btn-sm"
                                                                    wire:click.prevent="editTraveler({{ $index }})">
                                                                    {{ __('Edit') }}
                                                                </button>
                                                                <button class="btn btn-danger btn-sm"
                                                                    wire:click.prevent="removeTraveler({{ $index }})">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($this->steps[$currentStep] == 'SelectRoom')
                            <div class="col-sm-12">
                                <table id="datatables-rooms"
                                    class="table table-responsive table-striped dataTable no-footer dtr-inline"
                                    width="100%" aria-describedby="datatables-rooms_info" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Hotel') }}</th>
                                            <th>{{ __('Room Type') }}</th>
                                            <th>{{ __('Occupancy') }}</th>
                                            <th>{{ __('Bed Price') }}</th>
                                            <th>{{ __('Price') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($this->rooms->count())
                                        @foreach ($this->rooms as $room)
                                        <tr>
                                            <td><input
                                                class="form-check-input"type="radio"
                                                id="room_{{ $room->id }}"
                                                wire:model.live="selectedRoom"
                                                value="{{ $room->id }}"></td>
                                            <td>{{ $room->hotel->name }}</td>
                                            <td>{{ $room->type }}</td>
                                            <td>{{ $room->nb_beds}}</td>
                                            <td>   {{ __('DA', ['price' => $room->price_per_bed]) }}</td>
                                            <td>   {{ __('DA', ['price' => $room->price]) }}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                            @include('components.empty-table', [
                                                'message' => __('No Room has been found for reservation'),
                                                'colspan' => 6,
                                            ])
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="row mt-4 mb-4">
                                    <div class="col-12">
                                        <div class="card-header px-2 py-2" style="border-bottom: 1px solid #e9ecef;">
                                            <h5 class="card-title mb-0">{{ __('Reservation Summary') }}</h5>
                                        </div>
                                        <div class="py-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table">
                                                        <tr>
                                                            <td>{{__('Services')}}</td>
                                                            <td class="text-end" id="madinahHotelCost">
                                                                {{ __('DA', ['price' => $this->getTotalServicePrices()]) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('Room Type Supplement')}}:</td>
                                                            <td class="text-end" id="roomTypeCost">  {{ __('DA', ['price' =>  $this->roomsCost]) }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card bg-light">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ __('Total Reservation Cost')}}
                                                            </h5>
                                                            <div class="d-flex justify-content-between">
                                                                <h3 class="text-primary" id="totalReservationCost">
                                                                    {{ __('DA', ['price' => $this->getTotalServicePrices()+  $this->roomsCost]) }}
                                                                </h3>
                                                                <span class="badge bg-success align-self-center">{{ __('Final Price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                        <div class="col-12 text-end">
                            @if ($this->currentStep > 1)
                                <button type="button" wire:click.prevent="backStep()"
                                    class="btn btn-secondary">{{ __('Back') }}
                                </button>
                            @endif
                            @if (count($this->steps) > $this->currentStep)
                                <button type="button" wire:click.prevent="nextStep()"
                                    class="btn btn-primary">{{ __('Next') }}
                                </button>
                            @endif
                            @if ($this->steps[$currentStep] == 'SelectRoom' && $this->selectedRoom)
                                <button type="submit" wire:loading.attr="disabled"
                                    class="btn btn-primary btn-lg px-5">
                                    <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                                        role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                    {{ __('Save') }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div><script>
        function toggleService(type, serviceId) {
            const radio = document.getElementById(`service_${serviceId}`);

            if (radio.checked) {
                radio.checked = false;
                Livewire.emit('toggleService', type, null);
            } else {
                Livewire.emit('toggleService', type, serviceId);
            }
        }
    </script>
</main>
