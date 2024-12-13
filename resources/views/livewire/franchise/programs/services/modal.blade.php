<div class="modal fade" id="add-edit-service" aria-labelledby="add-edit-service"
    aria-hidden="true" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered @if (App::isLocale('ar')) rtl @endif" role="document">
        <div class="modal-content">
            <div class="modal-header p-3 d-flex justify-content-between">
                <h3 class="modal-title">{{ __($action . ' service') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    style="margin: 0 !important;" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="save" id="service-form" class="needs-validation">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" wire:model.defer="name" placeholder="{{ __('Service Name') }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                            <textarea class="form-control plaintext @error('description') is-invalid @enderror"
                                wire:model.defer='description' rows="4" placeholder="{{ __('Service Description') }}"></textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="price" class="form-label">{{ __('Price') }}</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                id="price" wire:model.defer="price" placeholder="{{ __('Service Price') }}">
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="type" class="form-label">{{ __('Select Type') }}</label>
                            <select wire:model.live="type" id="type" class="form-select @error('type') is-invalid @enderror">
                                <option value="">{{ __('Service Type') }}</option>
                                @foreach ($this->types as $type)
                                    <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="client-and-related" class="form-label">{{ __('Will the client and his companions share this service for the booking ?') }}</label>
                            <input type="checkbox" class="mx-2 @error('for_client_and_related') is-invalid @enderror"
                                id="client-and-related" wire:model.defer="for_client_and_related" style="width: 16px; height: 16px;">
                            @error('for_client_and_related')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-end pt-3">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary" form="service-form">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('close-modal', (event) => {
            $('#add-edit-service').modal('hide');
        });
    });
</script>
