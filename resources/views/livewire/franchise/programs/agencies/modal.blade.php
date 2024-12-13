<div class="modal fade" id="add-edit-agency" aria-labelledby="add-edit-agency"
    aria-hidden="true" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered @if (App::isLocale('ar')) rtl @endif" role="document">
        <div class="modal-content">
            <div class="modal-header p-3 d-flex justify-content-between">
                <h3 class="modal-title">{{ __($action . ' agency') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    style="margin: 0 !important;" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="save" id="agency-form" class="needs-validation">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="agency" class="form-label">{{ __('Select Agency') }}</label>
                            <select wire:model.live="agency" id="agency" class="form-select @error('agency') is-invalid @enderror">
                                <option value="">{{ __('Choose one of our agencies') }}</option>
                                @foreach ($this->agencies as $agency)
                                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                @endforeach
                            </select>
                            @error('agency')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="agency-gain" class="form-label">{{ __('Gain') }}</label>
                            <input type="text" class="form-control @error('agency_gain') is-invalid @enderror"
                                id="agency-gain" wire:model.defer="agency_gain" placeholder="{{ __('Agency Gain') }}">
                            @error('agency_gain')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-end pt-3">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary" form="agency-form">
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
            $('#add-edit-agency').modal('hide');
        });
    });
</script>
