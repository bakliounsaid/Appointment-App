<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Appointment Detail') }}</h1>
        </div>

        <!-- General Info Card -->
        <div style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);" class="card mb-4">
            <div style="border-bottom: 1px solid #e9ecef;" class="card-header">
                <h5 class="card-title mb-0">{{ __('Client Information') }}</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="firstname" class="form-label">{{ __('Firstname') }}</label>
                        <p class="form-control-plaintext" id="firstname">{{ $appointment->firstname }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="lastname" class="form-label">{{ __('Lastname') }}</label>
                        <p class="form-control-plaintext" id="lastname">{{ $appointment->lastname }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">{{ __('Phone') }}</label>
                        <p class="form-control-plaintext" id="phone">{{ $appointment->phone }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                        <p class="form-control-plaintext" id="address">{{ $appointment->address ?? '/' }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label">{{ __('City') }}</label>
                        <p class="form-control-plaintext" id="city">{{ $city }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="state" class="form-label">{{ __('State') }}</label>
                        <p class="form-control-plaintext" id="state">{{ $state }}</p>
                    </div>

                    <div class="col-md-4">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <p class="form-control-plaintext" id="email">{{ $appointment->email ?? '/' }}</p>
                    </div>

                    <div class="col-md-4">
                        <label for="localisation" class="form-label">{{ __('Localisation') }}(GPS)</label>
                        <p class="form-control-plaintext" id="localisation">{{ $appointment->localisation ?? '/' }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label for="windoows" class="form-label">{{ __('Windows Number') }}</label>
                        <p class="form-control-plaintext" id="windows">{{ $appointment->windows }}
                        </p>
                    </div>
                    <div style="border-bottom: 1px solid #e9ecef;" class="card-header">
                        <h5 class="card-title mb-0">{{ __('Appointment Information') }}</h5>
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label">{{ __('Requested Date') }}</label>
                        <p class="form-control-plaintext" id="date">{{ $appointment->formatted_client_date }}
                        </p>
                    </div>
                    @if ($appointment->admin_date && now() > $appointment->admin_date)
                        <div class="col-md-4">
                            <label for="date" class="form-label">{{ __('Confirmed Date') }}</label>
                            <p class="form-control-plaintext" id="adminDate">
                                {{ $appointment->formatted_admin_date }}</p>
                        </div>
                    @else
                        <div class="col-md-4">
                            <label for="adminDate" class="form-label">{{ __('Confirmed Date') }}</label>
                            <input type="date" class="form-control  @error('adminDate') is-invalid @enderror"
                                id="adminDate" wire:model.defer="adminDate">
                            @error('adminDate')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    @if ($appointment->latestStatus->status->name == 'Ongoing')
                        @if (!$appointment->assembly_date ||  now() <= $appointment->assembly_date)
                            <div class="col-md-4">
                                <label for="adminDate" class="form-label">{{ __('Assembly Date') }}</label>
                                <input type="date" class="form-control  @error('assemblyDate') is-invalid @enderror"
                                    id="assemblyDate" wire:model.defer="assemblyDate">
                                @error('assemblyDate')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                        <div class="col-md-4">
                            <label for="date" class="form-label">{{ __('Assembly Date') }}</label>
                            <p class="form-control-plaintext" id="adminDate">
                                {{ $appointment->formatted_assembly_date }}</p>
                        </div>
                        @endif
                    @endif
                    <div class="col-md-12">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <p class="form-control-plaintext" id="description">{{ $appointment->description ?? '/' }}
                        </p>
                    </div>
                </div>
                @if ($appointment->latestStatus->status->name == 'Pending')
                    <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                        <button wire:click ="confirme" wire:loading.attr="disabled" class="btn btn-primary btn-lg px-5">
                            <span wire:loading wire:target="confirme" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Confirm Appointment') }}
                        </button>
                    </div>
                @elseif($appointment->latestStatus->status->name == 'Validated' && now() < $appointment->admin_date)
                    <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                        <button wire:click ="confirme" wire:loading.attr="disabled"
                            class="btn btn-primary btn-lg px-5">
                            <span wire:loading wire:target="confirme" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Edit Appointment Date') }}
                        </button>
                    </div>
                @elseif($appointment->latestStatus->status->name == 'Validated' && now() >= $appointment->admin_date)
                    <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                        <button wire:click="assembly" wire:loading.attr="disabled"
                            class="btn btn-primary btn-lg px-5">
                            <span wire:loading wire:target="assembly" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Ongoing') }}
                        </button>
                    </div>
                @elseif ($appointment->latestStatus->status->name == 'Ongoing' && ( now() <= $appointment->assembly_date || !$appointment->assembly_date))
                    <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                        <button wire:click="dateAssembly" wire:loading.attr="disabled"
                            class="btn btn-primary btn-lg px-5">
                            <span wire:loading wire:target="dateAssembly" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Assembly Date') }}
                        </button>
                    </div>
                @elseif ($appointment->assembly_date && $appointment->latestStatus->status->name == 'Ongoing' && now() > $appointment->assembly_date)
                    <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                        <button wire:click="archive" wire:loading.attr="disabled"
                            class="btn btn-primary btn-lg px-5">
                            <span wire:loading wire:target="archive" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Archive') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
