<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('New Product') }}</h1>
        </div>
        <form wire:submit.prevent="save" class="needs-validation">
            <!-- General Info Card -->
            <div style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);" class="card mb-4">
                <div style="border-bottom: 1px solid #e9ecef;" class="card-header">
                    <h5 class="card-title mb-0">{{ __('Product Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="logo-wrapper" id="logoWrapper">
                            <span class="form-label d-block">{{ __('Product Images') }}</span>
                            <label for="images" class="upload-btn cursor-pointer">
                                {{ __('Select Product Images') }}
                            </label>
                            <input multiple type="file" id="images" wire:model="newImages" class="d-none @error('images') is-invalid @enderror"
                                accept="image/*">
                            @error('images')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            <div class="d-flex flex-wrap mt-2">
                                @foreach ($images as $index => $image)
                                    <div class="position-relative m-1">
                                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail"
                                            style="height: 100px;">
                                        <button type="button" wire:click="removeImage({{ $index }})"
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0">×</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="nameAr" class="form-label">{{ __('Name_Ar') }}</label>
                            <input type="text" class="form-control @error('nameAr') is-invalid @enderror"
                                id="nameAr" wire:model.defer="nameAr" placeholder="{{ __('Name_Ar') }}">
                            @error('nameAr')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nameFr" class="form-label">{{ __('Name_Fr') }}</label>
                            <input type="text" class="form-control @error('nameFr') is-invalid @enderror"
                                id="nameFr" wire:model.defer="nameFr" placeholder="{{ __('Name_Fr') }}">
                            @error('nameFr')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="descriptionAr" class="form-label">{{ __('Description_Ar') }}</label>
                            <textarea type="text" class="form-control @error('descriptionAr') is-invalid @enderror" id="descriptionAr"
                                wire:model.defer="descriptionAr" placeholder="{{ __('Description_Ar') }}">
                            </textarea>
                            @error('descriptionAr')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="descriptionAr" class="form-label">{{ __('Description_Fr') }}</label>
                            <textarea class="form-control @error('descriptionAr') is-invalid @enderror" id="descriptionFr"
                                wire:model.defer="descriptionFr" placeholder="{{ __('Description_Fr') }}">
                          </textarea>
                            @error('descriptionFr')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">{{ __('Price') }}</label>
                            <input type="number" min="0.01" step="0.01"
                                class="form-control @error('price') is-invalid @enderror" id="price"
                                wire:model.defer="price" placeholder="{{ __('Price') }}">
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="available" class="form-label d-block">{{ __('Available') }}</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input switch-success" type="checkbox" id="available"
                                    wire:model.defer="available">
                            </div>
                            @error('available')
                                <span class="text-danger small">{{ $message }}</span>
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
