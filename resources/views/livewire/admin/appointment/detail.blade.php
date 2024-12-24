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
                @if($appointment->latestStatus->status->name == "Validated" && (now() > $appointment->admin_date))
                <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                    <button wire:click="archive" wire:loading.attr="disabled" class="btn btn-primary btn-lg px-5">
                        <span wire:loading wire:target="archive" class="spinner-border spinner-border-sm"
                            role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Archive') }}
                        </button>
                </div>
                @endif
                <form wire:submit.prevent="confirme" class="needs-validation">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">{{ __('Firstname') }}</label>
                            <p class="form-control-plaintext" id="firstname">{{ $appointment->firstname }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">{{ __('Lastname') }}</label>
                            <p class="form-control-plaintext" id="lastname">{{ $appointment->lastname }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">{{ __('Phone') }}</label>
                            <p class="form-control-plaintext" id="phone">{{ $appointment->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <p class="form-control-plaintext" id="email">{{ $appointment->email ?? '/' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">{{ __('City') }}</label>
                            <p class="form-control-plaintext" id="city">{{ $city }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="state" class="form-label">{{ __('State') }}</label>
                            <p class="form-control-plaintext" id="state">{{ $state }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">{{ __('Address') }}</label>
                            <p class="form-control-plaintext" id="address">{{ $appointment->address ?? '/' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="localisation" class="form-label">{{ __('Localisation') }}</label>
                            <p class="form-control-plaintext" id="localisation">{{ $appointment->localisation ?? '/' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label for="date" class="form-label">{{ __('Requested Date') }}</label>
                            <p class="form-control-plaintext" id="date">{{ $appointment->formatted_client_date }}</p>
                        </div>
                        @if(now() > $appointment->admin_date)
                        <div class="col-md-6">
                            <label for="date" class="form-label">{{ __('Confirmed Date') }}</label>
                            <p class="form-control-plaintext" id="adminDate">{{ $appointment->formatted_admin_date }}</p>
                        </div>
                        @else
                        <div class="col-md-6">
                            <label for="adminDate" class="form-label">{{ __('Confirmed Date') }}</label>
                            <input type="date" class="form-control  @error('adminDate') is-invalid @enderror"
                                id="adminDate" wire:model.defer="adminDate">
                            @error('adminDate')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <div class="col-md-12">
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                            <p class="form-control-plaintext" id="description">{{ $appointment->description ?? '/' }}
                            </p>
                        </div>
                    </div>
                    @if($appointment->latestStatus->status->name == "Pending")
                    <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-lg px-5">
                            <span wire:loading wire:target="confirme" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Validate') }}
                        </button>
                    </div>
                    @elseif($appointment->latestStatus->status->name == "Validated" && (now() < $appointment->admin_date))
                     <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-lg px-5">
                            <span wire:loading wire:target="confirme" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                {{ __('Edit') }}
                            </button>
                    </div>
                    @endif
                </div>
            </form>
            </div>

    </div>
</main>
