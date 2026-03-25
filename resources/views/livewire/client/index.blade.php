    <section class="sections-bg-gradient appointment-section container-fluid" id="contact" style="padding: 100px 0;">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 style="color: #F5F5F5 !important;" class="section-heading">
                        {{ __('Request an Appointment') }}
                        <span class="heading-border-bottom"></span>
                    </h2>
                    <p style="color: #F5F5F5;">{{ __('Request an appointment to discuss your work-related needs') }}</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-form appointment-form">
                        <form wire:submit.prevent="save">
                            @if (!$successPage)
                                <div class="row g-4">
                                    <div class="col-md-6">
{{--                                         <label class="form-label">{{ __('Firstname') }}</label>
 --}}                                        <input type="text" placeholder="{{ __('Firstname') }}"
                                            wire:model.defer="firstname">
                                        @error('firstname')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
{{--                                         <label class="form-label">{{ __('Lastname') }}</label>
 --}}                                        <input type="text" placeholder="{{ __('Lastname') }}"
                                            wire:model.defer="lastname">
                                        @error('lastname')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
{{--                                         <label class="form-label">{{ __('Phone One') }}</label>
 --}}                                        <input type="text" placeholder="{{ __('Phone One') }}"
                                            wire:model.defer="phone">
                                        @error('phone')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
{{--                                         <label class="form-label">{{ __('Confirm Phone One') }}</label>
 --}}                                        <input type="text" placeholder="{{ __('Confirm Phone One') }}"
                                            wire:model.defer="phone_confirmation">
                                        @error('phone_confirmation')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                       {{--  <label class="form-label">{{ __('Phone Two') }}</label>
                                        <span class="text-muted small">({{ __('optional') }})</span> --}}

                                        <input type="text" placeholder="{{ __('Phone Two') }}({{ __('optional') }})"
                                            wire:model.defer="phoneTwo">
                                        @error('phoneTwo')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                         <div class="col-md-6">
                                        {{-- <label class="form-label">{{ __('Email') }}</label>
                                        <span class="text-muted small">({{ __('optional') }})</span> --}}

                                        <input type="email" placeholder="{{ __('Email') }} ({{ __('optional') }})"
                                            wire:model.defer="email">
                                        @error('email')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                {{--                     <div class="col-md-6">
                                        <label class="form-label">{{ __('Address') }}</label>
                                        <span class="text-muted small">({{ __('optional') }})</span>

                                        <input type="text" placeholder="{{ __('Address') }}"
                                            wire:model.defer="address">
                                        @error('address')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('State') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-gold-500">
                                                <svg width="20" height="20" fill="currentColor"
                                                    class="text-white" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 384 512">
                                                    <path
                                                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                                </svg>
                                            </span>
                                            <select class="form-select" wire:model.live="state">
                                                <option value="">{{ __('Select State') }}</option>
                                                @foreach ($this->states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->{$this->locale . '_name'} }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('state')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('City') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-gold-500">
                                                <svg width="20" height="20" fill="currentColor"
                                                    class="text-white" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 384 512">
                                                    <path
                                                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                                </svg>
                                            </span>
                                            <select class="form-select" wire:model.defer="city">
                                                <option value="">{{ __('Select City') }}</option>
                                                @foreach ($this->cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->{$this->locale . '_name'} }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('city')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>


                            {{--         <div class="col-md-6">
                                        <label class="form-label">{{ __('Localisation') }}(GPS)</label>
                                        <span class="text-muted small">({{ __('optional') }})</span>

                                        <input type="text" placeholder="{{ __('Localisation') }}"
                                            wire:model.defer="location">
                                        @error('location')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Date_preferee ') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-gold-500">
                                                <svg width="20" height="20" fill="currentColor"
                                                    class="text-white" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 448 512">
                                                    <path
                                                        d="M96 32l0 32L48 64C21.5 64 0 85.5 0 112l0 48 448 0 0-48c0-26.5-21.5-48-48-48l-48 0 0-32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 32L160 64l0-32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192L0 192 0 464c0 26.5 21.5 48 48 48l352 0c26.5 0 48-21.5 48-48l0-272z" />
                                                </svg>
                                            </span>
                                            <input type="date" wire:model.defer="date"
                                                class="form-control border-gold-500" id="departureDate">
                                        </div>
                                        @error('date')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                      <div class="col-md-6">
                                        <label class="form-label">{{ __('Windows Number') }}</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary" type="button"
                                                wire:click="incrementWindows">+</button>
                                                 <button class="btn btn-outline-secondary" type="button"
                                                wire:click="decrementWindows">−</button>
                                            <input type="text" class="form-control text-center fw-bold"
                                                value="{{ $windows }}" readonly>
                                        </div>

                                        @error('windows')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">{{ __('Description') }}</label>
                                        <span class="text-muted small">({{ __('optional') }})</span>

                                        <textarea placeholder="{{ __('Description') }}" wire:model.defer="description"></textarea>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <h2 class="form-label"><u>{{ __('Note') }} :</u></h2>
                                        <p class="text-blue section-heading">
                                            {{ __('The placement fee is 3000 Da and must be deducted from the overall quotation') }}
                                        </p>

                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" wire:loading.attr="disabled"
                                            class="bg-success text-white px-4 py-3 border-0 rounded-3 fw-bold fs-5 d-flex align-items-center gap-2">
                                            <span wire:loading wire:target="save"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                            {{ __('Take Appointment') }}
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 text-center">
                                    <h4 class="text-black section-heading mb-3">
                                        {{ __('Appointment successfully registered!') }}</h4>
                                    </br>
                                    <p class="text-black section-heading mb-0">
                                        {{ __('You will be contacted soon.') }}
                                    </p>
                                    <p class="mt-3">
                                        <a href="{{ route('client.product.index') }}"
                                            class="text-primary text-decoration-underline">
                                            {{ __('Our Products') }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const section = document.getElementById("contact");

            const images = [
                "{{ asset('images/bg/5.png') }}",
                "{{ asset('images/bg/6.png') }}"
            ];

            let index = 0;
            section.style.backgroundImage = `url(${images[index]})`;

            setInterval(() => {
                index = (index + 1) % images.length;
                section.style.backgroundImage = `url(${images[index]})`;
            }, 4000);
        });
    </script>
