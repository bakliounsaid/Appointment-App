<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Edit Product') }}</h1>
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
                            <span class="form-label d-block ">{{ __('product Image') }}</span>
                            <label for="images" class="upload-btn cursor-pointer">
                                {{ __('Select Product Image') }}
                            </label>
                            <input multiple type="file" id="images" wire:model="newImages"
                                class="d-none @error('images') is-invalid @enderror" accept="image/*">
                            @error('images')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            <div class="logo-preview-container gap-3 mt-3 overflow-hidden"
                                style="display: flex; flex-wrap: wrap; gap: 10px;">
                                @foreach ($images as $index => $img)
                                    <div style="position: relative; display: inline-block;">
                                        @if (is_string($img))
                                            <img src="{{ asset('storage/' . $img) }}" class="logo-preview bg-white"
                                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 4px;"
                                                alt="Existing Image">
                                        @else
                                            <img src="{{ $img->temporaryUrl() }}" class="logo-preview bg-white"
                                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 4px;"
                                                alt="New Image">
                                        @endif
                                        <button type="button" wire:click="removeImage({{ $index }})"
                                            style="position: absolute; top: 2px; right: 2px; background: rgba(255,0,0,0.7); border: none; color: white; border-radius: 50%; width: 25px; height: 25px; cursor: pointer;">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nameAr" class="form-label">{{ __('Name_Ar') }}</label>
                            <input type="text" class="form-control @error('product.name_ar') is-invalid @enderror"
                                id="nameAr" wire:model.defer="product.name_ar" placeholder="{{ __('Name_Ar') }}">
                            @error('product.name_ar')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nameFr" class="form-label">{{ __('Name_Fr') }}</label>
                            <input type="text" class="form-control @error('product.name_fr') is-invalid @enderror"
                                id="nameFr" wire:model.defer="product.name_fr" placeholder="{{ __('Name_Fr') }}">
                            @error('product.name_fr')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="descriptionAr" class="form-label">{{ __('Description_Ar') }}</label>
                            <textarea type="text" class="form-control @error('product.description_ar') is-invalid @enderror" id="descriptionAr"
                                wire:model.defer="product.description_ar" placeholder="{{ __('Description_Ar') }}">
                            </textarea>
                            @error('product.description_ar')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="descriptionAr" class="form-label">{{ __('Description_Fr') }}</label>
                            <textarea class="form-control @error('product.description_fr') is-invalid @enderror" id="descriptionFr"
                                wire:model.defer="product.description_fr" placeholder="{{ __('Description_Fr') }}">
                          </textarea>
                            @error('product.description_fr')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">{{ __('Price') }}</label>
                            <input type="number" min="0.01" step="0.01"
                                class="form-control @error('product.price') is-invalid @enderror" id="price"
                                wire:model.defer="product.price" placeholder="{{ __('Price') }}">
                            @error('product.price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                     {{--    <div class="col-md-6">
                            <label for="available" class="form-label d-block">{{ __('Available') }}</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input switch-success" type="checkbox" id="available"
                                    wire:model.live="available" />
                            </div>
                            @error('available')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div> --}}
                         <div class="col-md-6">
                            <label for="category" class="form-label">{{ __('Category') }}</label>
                            <select id="category"
                                class="form-control @error('category') is-invalid @enderror"
                                wire:model.defer="category">
                                <option value="">{{ __('Select a Category') }}</option>
                                @foreach ($this->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->{'name_' . $language} }}</option>
                                @endforeach
                            </select>
                            @error('category')
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
        </form>
    </div>
</main>

<script>
    document.addEventListener('livewire:load', function() {
        const logoInput = document.getElementById('image');

        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
        });
    });
</script>
