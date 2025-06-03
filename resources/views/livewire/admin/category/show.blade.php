<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Edit Category') }}</h1>
        </div>
        <form wire:submit.prevent="save" class="needs-validation">
            <!-- General Info Card -->
            <div style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);" class="card mb-4">
                <div style="border-bottom: 1px solid #e9ecef;" class="card-header">
                    <h5 class="card-title mb-0">{{ __('Category Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nameAr" class="form-label">{{ __('Name_Ar') }}</label>
                            <input type="text" class="form-control @error('category.name_ar') is-invalid @enderror"
                                id="nameAr" wire:model.defer="category.name_ar" placeholder="{{ __('Name_Ar') }}">
                            @error('category.name_ar')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nameFr" class="form-label">{{ __('Name_Fr') }}</label>
                            <input type="text" class="form-control @error('category.name_fr') is-invalid @enderror"
                                id="nameFr" wire:model.defer="category.name_fr" placeholder="{{ __('Name_Fr') }}">
                            @error('category.name_fr')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-end m-3">
                            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-lg px-5">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
