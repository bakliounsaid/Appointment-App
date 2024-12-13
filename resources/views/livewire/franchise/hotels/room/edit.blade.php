<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Edit Room') }}</h1>
        </div>
        <form wire:submit.prevent="save" class="needs-validation">
            <!-- General Info Card -->
            <div class="card mb-4" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
                <div class="card-header" style="border-bottom: 1px solid #e9ecef;">
                    <h5 class="card-title mb-0">{{ __('Room Details') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 mt-3">

                        <!-- Room Type Field -->
                        <div class="col-md-6">
                            <label for="Type"
                                class="form-label ">{{ __('Room Type') }}</label>
                            <input type="text" class="form-control @error('room.type') is-invalid @enderror"
                                id="Type" wire:model.defer="room.type" placeholder="{{ __('Room Type') }}">
                            @error('room.type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Number of Beds Field -->
                        <div class="col-md-6">
                            <label for="Nb_beds"
                                class="form-label ">{{ __('Number of Beds') }}</label>
                            <input type="number" class="form-control @error('room.nb_beds') is-invalid @enderror"
                                id="Nb_beds" wire:model.defer="room.nb_beds"
                                placeholder="{{ __('Number of Beds') }}">
                            @error('room.nb_beds')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Max Adults Field -->
                        <div class="col-md-6">
                            <label for="Max_adult"
                                class="form-label ">{{ __('Max Adults') }}</label>
                            <input type="number" class="form-control @error('room.max_adult') is-invalid @enderror"
                                id="Max_adult" wire:model.defer="room.max_adult" placeholder="{{ __('Max Adults') }}">
                            @error('room.max_adult')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Max Children Field -->
                        <div class="col-md-6">
                            <label for="Max_children"
                                class="form-label ">{{ __('Max Children') }}</label>
                            <input type="number" class="form-control @error('room.max_children') is-invalid @enderror"
                                id="Max_children" wire:model.defer="room.max_children"
                                placeholder="{{ __('Max Children') }}">
                            @error('room.max_children')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Price Field -->
                        <div class="col-md-6">
                            <label for="Price"
                                class="form-label ">{{ __('Price') }}</label>
                            <input type="number" step="0.01"
                                class="form-control @error('room.price') is-invalid @enderror" id="Price"
                                wire:model.defer="room.price" placeholder="{{ __('Price') }}">
                            @error('room.price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Price Per Bed Field -->
                        <div class="col-md-6">
                            <label for="Price_per_bed"
                                class="form-label ">{{ __('Price Per Bed') }}</label>
                            <input type="number" step="0.01"
                                class="form-control @error('room.price_per_bed') is-invalid @enderror"
                                id="Price_per_bed" wire:model.defer="room.price_per_bed"
                                placeholder="{{ __('Price Per Bed') }}">
                            @error('room.price_per_bed')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Amenities Field -->
                        <div class="col-md-6">
                            <label for="Amenities"
                                class="form-label ">{{ __('Amenities') }}</label>
                            <textarea wire:model.defer="room.amenities" id="amenities" placeholder="{{ __('Enter available amenities') }}"
                                class="form-control @error('room.amenities') is-invalid @enderror"></textarea>
                            @error('room.amenities')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Description Field -->
                        <div class="col-md-6">
                            <label for="Description"
                                class="form-label ">{{ __('Description') }}</label>
                            <textarea wire:model.defer="room.description" id="description" placeholder="{{ __('Enter room description') }}"
                                class="form-control @error('room.description') is-invalid @enderror"></textarea>
                            @error('room.description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row g-3 mt-3">
                            <!-- Room Status Field -->
                            <div class="col-md-6">
                                <label for="Status"
                                    class="form-label ">{{ __('Status') }}</label>
                                <select class="form-control @error('room.status') is-invalid @enderror" id="Status"
                                    wire:model.defer="room.status">
                                    @foreach ($roomStatus as $status)
                                        <option value="{{ $status->value }}"
                                            {{ $room->status == $status->value ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('room.status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-end pt-3">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
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
