<div class="modal fade" id="add-edit-age" aria-labelledby="add-edit-age"
    aria-hidden="true" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered @if (App::isLocale('ar')) rtl @endif" role="document">
        <div class="modal-content">
            <div class="modal-header p-3 d-flex justify-content-between">
                <h3 class="modal-title">{{ __($action . ' age range') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    style="margin: 0 !important;" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="save" id="age-range-form" class="needs-validation">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" wire:model.defer="name" placeholder="{{ __('Age Range') }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="min-age" class="form-label">{{ __('Minimum Age') }}</label>
                                <input type="number" class="form-control @error('min_age') is-invalid @enderror"
                                id="min-age" wire:model.defer="min_age" min="0" step="1">
                            @error('min_age')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="max-age" class="form-label">{{ __('Maximum Age') }}</label>
                                <input type="text" class="form-control @error('max_age') is-invalid @enderror"
                                id="max-age" wire:model.defer="max_age" min="0" step="1">
                            @error('max_age')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="price" class="form-label">{{ __('Price') }}</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                id="price" wire:model.defer="price" placeholder="{{ __('Range Price') }}">
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-end pt-3">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary" form="age-range-form">
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
            $('#add-edit-age').modal('hide');
        });
    });
</script>
