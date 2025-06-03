<section class="sections-bg-gradient container-fluid" id="product-detail" style="padding: 100px 0;">
    <div class="container">
        @if (!$successPage)

            <div class="row justify-content-center">
                {{-- Left: Fixed size big image + thumbnails --}}
                <div class="col-lg-5 mb-4">
                    <div class="card border-0 rounded-4 shadow-sm">
                        <img id="mainImage" src="{{ asset('storage/' . $product->media->first()->url) }}"
                            alt="{{ $product->name_ar }}" class="img-fluid rounded-top-4 object-fit-contain"
                            style="height: 500px; width: 100%; object-fit: contain;" />

                        {{-- Thumbnails --}}
                        <div class="d-flex gap-2 p-3 flex-wrap">
                            @foreach ($product->media as $media)
                                <img src="{{ asset('storage/' . $media->url) }}"
                                    alt="{{ $product->{'name_' . $language} }}"
                                    class="img-thumbnail rounded-3 thumbnail-image"
                                    style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                    onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $media->url) }}'" />
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Right: Product info + buy form --}}
                <div class="card rounded-4 shadow-sm col-lg-6 d-flex flex-column justify-content-center">
                    <h2 class="text-black fw-bold mb-3">{{ $product->{'name_' . $language} }}</h2>
                    <p class="text-muted mb-4" style="line-height: 1.4;">{{ $product->{'description_' . $language} }}
                    </p>
                    <h3 class="text-success fw-bold mb-4">{{ number_format($product->price, 2) }} {{ __('Currency') }}
                    </h3>

                    <form wire:submit.prevent="save">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
                                <input type="text" id="name" wire:model.defer="name" class="form-control"
                                    placeholder="{{ __('Enter your name') }}">
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold">{{ __('Phone') }}</label>
                                <input type="tel" id="phone" wire:model.defer="phone" class="form-control"
                                    placeholder="{{ __('Enter your phone number') }}">
                                @error('phone')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="quantity" class="form-label fw-semibold">{{ __('Quantity') }}</label>
                                <input type="number" id="quantity" wire:model.live="quantity" min="1"
                                    class="form-control">
                                @error('quantity')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">{{ __('Type of Delivery') }}</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model.live="deliveryType"
                                            id="domicile" value="0">
                                        <label class="form-check-label" for="domicile">🏠 {{ __('Domicile') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model.live="deliveryType"
                                            id="stopdesk" value="1">
                                        <label class="form-check-label" for="stopdesk">🚗 {{ __('Stopdesk') }}</label>
                                    </div>
                                </div>
                                @error('deliveryType')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">{{ __('State') }}</label>
                                <select wire:model.live="selectedState" class="form-select">
                                    <option value="">{{ __('Choose state') }}</option>
                                    @foreach ($this->states as $state)
                                        <option value="{{ $state->id }}">{{ $state->{$language . '_name'} }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedState')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (!$this->deliveryType)
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ __('City') }}</label>
                                    <select wire:model.live="selectedCity" class="form-select">
                                        <option value="">{{ __('Choose city') }}</option>
                                        @foreach ($this->cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->{$language . '_name'} }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('selectedCity')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($this->deliveryPrice && $this->productPrice)
                                <div class="col-md-12" >
                                    <p style="font-size: 14px !important;" class="fw-semibold mt-3">{{ __('Product Price') }}:
                                        <span class="text-primary">{{ number_format($this->productPrice, 2) }}
                                            {{ __('Currency') }}</span>
                                    </p>
                                    <p style="font-size: 14px !important;" class="fw-semibold mt-3">{{ __('Delivery Price') }}:
                                        <span class="text-primary">{{ number_format($this->deliveryPrice, 2) }}
                                            {{ __('Currency') }}</span>
                                    </p>
                                    <p style="font-size: 14px !important;" class="fw-bold">{{ __('Total Price') }}:
                                        <span
                                            class="text-success">{{ number_format($this->productPrice + $this->deliveryPrice, 2) }}
                                            {{ __('Currency') }}</span>
                                    </p>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100 fw-bold mt-4"><span wire:loading
                                wire:target="save" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                            {{ __('Order Now') }}

                        </button>
                    </form>
                </div>
            </div>
     @else
    <div class="col-12 text-center">
        <h4 class="text-black section-heading mb-3">{{ __('order_success') }}</h4>
        <br>
        <p class="text-black section-heading mb-0">
            {{ __('contact_confirmation') }}
        </p>
      <p class="mt-3">
            <a href="{{ route('client.product.index') }}" class="text-primary text-decoration-underline">
                {{ __('continue_shopping') }}
            </a>
        </p>
    </div>
@endif
    </div>
</section>

<script>
    const thumbnails = document.querySelectorAll('.thumbnail-image');
    const mainImage = document.getElementById('mainImage');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', () => {
            mainImage.src = thumb.src;
            thumbnails.forEach(t => t.classList.remove('border-success', 'border-3'));
            thumb.classList.add('border-success', 'border-3');
        });
    });

    if (thumbnails.length) {
        thumbnails[0].classList.add('border-success', 'border-3');
    }
</script>
