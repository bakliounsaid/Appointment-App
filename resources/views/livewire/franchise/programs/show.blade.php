<main class="content">
    <div class="container-fluid p-0">
        <form wire:submit.prevent="edit" class="needs-validation">
            <div class="mb-3">
                {{ Breadcrumbs::render('franchise.programs.edit',$program) }}
            </div>
            <!-- General Info Card -->
            <div class="card mb-4" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
                <div style="border-bottom: 1px solid #e9ecef;" class="card-header">
                    <h5 class="card-title mb-0">{{ __('Program Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title"
                                class="form-label ">{{ __('Title') }}</label>
                            <input type="text" class="form-control @error('program.title') is-invalid @enderror"
                                id="title" wire:model.defer="program.title" placeholder="{{ __('Program Title') }}">
                            @error('program.title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nb-places"
                                class="form-label ">{{ __('Places number') }}</label>
                            <input type="number" min="1"
                                class="form-control @error('program.nb_places') is-invalid @enderror" id="nb-places"
                                wire:model.defer="program.nb_places" placeholder="{{ __('Places number') }}">
                            @error('program.nb_places')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="start-date"
                                class="form-label ">{{ __('Start date') }}</label>
                            <input type="date" class="form-control @error('program.start_date') is-invalid @enderror"
                                id="start-date" wire:model.defer="program.start_date"
                                placeholder="{{ __('Start date') }}" min="{{ date('Y-m-d') }}">
                            @error('program.start_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end-date"
                                class="form-label ">{{ __('End date') }}</label>
                            <input type="date" class="form-control @error('program.end_date') is-invalid @enderror"
                                id="end-date" wire:model.defer="program.end_date" placeholder="{{ __('End date') }}"
                                min="{{ date('Y-m-d') }}">
                            @error('program.end_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="flight" class="form-label">{{ __('Select Flight') }}</label>
                            <select wire:model.live="flight" id="flight" class="form-select @error('flight') is-invalid @enderror">
                                <option value="">{{ __('Choose a Flight') }}</option>
                                @if ($this->program->nb_places)
                                    @foreach ($this->flights as $flight)
                                        <option value="{{ $flight->id }}"><b>{{ $flight->flight_number }}</b>
                                            [{{ $flight->departure_date->format('d/m/Y') }}-{{ $flight->arrival_date->format('d/m/Y') }}]</option>
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('flight')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="min-instalment-payment"
                                class="form-label ">{{ __('Minimum Instalment Payment') }}</label>
                            <input type="number" step="0.01"
                                class="form-control @error('program.min_instalment_payment') is-invalid @enderror"
                                id="min-instalment-payment" wire:model.defer="program.min_instalment_payment"
                                placeholder="{{ __('Minimum Instalment Payment') }}">
                            @error('program.min_instalment_payment')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="nb-instalments"
                                class="form-label ">{{ __('Number of instalments') }}</label>
                            <input type="number" min="1"
                                class="form-control @error('program.nb_instalments') is-invalid @enderror"
                                id="nb-instalments" wire:model.defer="program.nb_instalments"
                                placeholder="{{ __('Number of instalments') }}">
                            @error('program.nb_instalments')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="franchise-gain"
                                class="form-label ">{{ __('Franchise Gain') }}</label>
                            <input type="number" step="0.01"
                                class="form-control @error('program.franchise_gain') is-invalid @enderror"
                                id="franchise-gain" wire:model.defer="program.franchise_gain"
                                placeholder="{{ __('Franchise Gain') }}">
                            @error('program.franchise_gain')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-12">
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea class="form-control plaintext @error('program.description') is-invalid @enderror"
                                    wire:model.defer='program.description'></textarea>
                            @error('program.description')
                                <span class="invalid-feedback">{{ $message }}</span>
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
    </div>

    @livewire('franchise.programs.services.index', ['program' => $program])
    @livewire('franchise.programs.ages.index', ['program' => $program])
    @livewire('franchise.programs.agencies.index', ['program' => $program])
</main>
