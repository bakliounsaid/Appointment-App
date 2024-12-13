<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('New Flight') }}</h1>
        </div>
        <form wire:submit.prevent="save" class="needs-validation">
            <!-- General Info Card -->
            <div class="card mb-4" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
                <div class="card-header" style="border-bottom: 1px solid #e9ecef;">
                    <h5 class="card-title mb-0">{{ __('Flight Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="estimated_departure_time" style="font-weight: 500;"
                                class="form-label">{{ __('Estimated departure time') }}</label>
                            <input type="time"
                                class="form-control @error('flight.estimated_departure_time') is-invalid @enderror"
                                id="estimated_departure_time" wire:model.defer="flight.estimated_departure_time"
                                placeholder="{{ __('Enter Estimated Departure Time') }}">
                            @error('flight.estimated_departure_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="estimated_arrival_time" style="font-weight: 500;"
                                class="form-label">{{ __('Estimated arrival time') }}</label>
                            <input type="time"
                                class="form-control @error('flight.estimated_arrival_time') is-invalid @enderror"
                                id="estimated_arrival_time" wire:model.defer="flight.estimated_arrival_time"
                                placeholder="{{ __('Enter Estimated Arrival Time') }}">
                            @error('flight.estimated_arrival_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="departure_date" style="font-weight: 500;"
                                class="form-label">{{ __('Departure date') }}</label>
                            <input type="date"
                                class="form-control @error('flight.departure_date') is-invalid @enderror"
                                id="departure_date" wire:model.defer="flight.departure_date"
                                placeholder="{{ __('Select Departure Date') }}">
                            @error('flight.departure_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="arrival_date" style="font-weight: 500;"
                                class="form-label">{{ __('Arrival date') }}</label>
                            <input type="date"
                                class="form-control @error('flight.arrival_date') is-invalid @enderror"
                                id="arrival_date" wire:model.defer="flight.arrival_date"
                                placeholder="{{ __('Select Arrival Date') }}">
                            @error('flight.arrival_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="flight_number" style="font-weight: 500;"
                                class="form-label">{{ __('Flight number') }}</label>
                            <input type="text"
                                class="form-control @error('flight.flight_number') is-invalid @enderror"
                                id="flight_number" wire:model.defer="flight.flight_number"
                                placeholder="{{ __('Enter Flight Number') }}">
                            @error('flight.flight_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="nb_places" style="font-weight: 500;"
                                class="form-label">{{ __('Number places') }}</label>
                            <input type="number"
                                class="form-control @error('flight.nb_places') is-invalid @enderror"
                                id="flight.nb_places" wire:model.defer="flight.nb_places"
                                placeholder="{{ __('Enter places Number') }}">
                            @error('flight.nb_places')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="type" style="font-weight: 500;"
                                class="form-label">{{ __('Type') }}</label>
                            <select class="form-control @error('flight.type') is-invalid @enderror" id="type"
                                wire:model.defer="flight.type">
                                <option value="">{{ __('Select Type') }}</option>
                                <option value="direct">{{ __('Direct') }}</option>
                                <option value="indirect">{{ __('Indirect') }}</option>
                            </select>
                            @error('flight.type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-end pt-3">
                        <button type="" wire:loading.attr="disabled" class="btn btn-primary">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
