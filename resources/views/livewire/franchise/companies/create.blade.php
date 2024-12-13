{{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            {{ Breadcrumbs::render('franchise.companies.create') }}
        </div>
        <form wire:submit.prevent="save" class="needs-validation">
            <!-- General Info Card -->
            <div class="card mb-4" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
                <div class="card-header" style="border-bottom: 1px solid #e9ecef;">
                    <h5 class="card-title mb-0">{{ __('Company Information') }}</h5>
                </div>
                <div class="card-body">

                    <div class="row g-3 mt-3">
                        <div class="logo-wrapper" id="logoWrapper">
                            <span style="font-weight: 500;" class="form-label d-block">{{ __('Company logo') }}</span>
                            <label for="logo" class="upload-btn cursor-pointer">
                                {{ __('Select Company logo') }}
                            </label>
                            <input type="file" id="logo" wire:model="company.logo"
                                class="d-none @error('company.logo') is-invalid @enderror" accept="image/*">
                            @error('company.logo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            <div class="logo-preview-container gap-3 mt-3 overflow-hidden {{ $company->logo ? 'show' : '' }}"
                                id="previewContainer">
                                @if ($company->logo)
                                    <img id="logoPreview" class="logo-preview bg-white" alt="Logo preview"
                                        src="{{ $company->logo->temporaryUrl() }}">
                                    <div class="file-info">
                                        <span class="file-name" id="fileName">
                                            {{ $company->logo->getClientOriginalName() }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="name"
                                class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('company.name') is-invalid @enderror"
                                id="name" wire:model.defer="company.name" placeholder="{{ __('Name') }}">
                            @error('company.name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="Status"
                                class="form-label">{{ __('Status') }}</label>
                            <select type="number" step="0.01"
                                class="form-control @error('company.type') is-invalid @enderror" id="Status"
                                wire:model.defer="company.type" placeholder="{{ __('Status') }}">
                                @foreach ($companyType as $type)
                                    <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                @endforeach

                            </select>
                            @error('company.type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
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

<script>
    document.addEventListener('livewire:load', function() {
        const logoInput = document.getElementById('logo');

        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Let Livewire handle the file upload and preview
            Livewire.emit('imageUploaded');
        });
    });
</script>
