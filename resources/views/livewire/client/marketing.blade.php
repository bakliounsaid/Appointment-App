    <section class="sections-bg-gradient appointment-section container-fluid" id="contact" style="padding: 100px 0; background-image: url('{{ asset('images/bg/5.png') }}');">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 style="color: #F5F5F5 !important;" class="section-heading">
                        {{ __('Let Us Install Your Curtains') }}
                        <span class="heading-border-bottom"></span>
                    </h2>
                    <p style="color: #F5F5F5;">{{ __("Have a curtain, blind, or sheer project in mind? Fill out this form and we'll get back to you within 24 hours with a free, no-obligation quote") }}</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-form appointment-form">
                        <form wire:submit.prevent="save">
                               @if (!$successPage)
                                <div class="row g-4">
                                    <div class="col-md-12">
                                     <input type="text" placeholder="{{ __('FullName') }}"
                                            wire:model.defer="fullName">
                                        @error('fullName')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                    <input type="text" placeholder="{{ __('Phone') }}"
                                            wire:model.defer="phone">
                                        @error('phone')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>


                                         <div class="col-md-6">

                                        <input type="email" placeholder="{{ __('Email') }} ({{ __('optional') }})"
                                            wire:model.defer="email">
                                        @error('email')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

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
                                       <div class="col-12">
                                        <label class="form-label">{{ __('Description') }}</label>
                                        <span class="text-muted small">({{ __('optional') }})</span>

                                        <textarea placeholder="{{ __('Description') }}" wire:model.defer="description"></textarea>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                      <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" wire:loading.attr="disabled"
                                            class="bg-success text-white px-4 py-3 border-0 rounded-3 fw-bold fs-5 d-flex align-items-center gap-2">
                                            <span wire:loading wire:target="save"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 text-center">
                                    <h4 class="text-black section-heading mb-3">
                                        {{ __("Thank you! Your request has been successfully registered") }}</h4>
                                    </br>
                                    <p class="text-black section-heading mb-0">
                                        {{ __('We will contact you within 24 hours.') }}
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

