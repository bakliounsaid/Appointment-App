@section('meta')
    <meta property="og:title" content="{{ $product->name_fr }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($product->description_fr), 150) }}" />
    <meta property="og:image" content="{{ asset('storage/' . $product->media->first()->url) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="product" />

    <!-- Twitter -->
    <meta name="twitter:title" content="{{ $product->name_fr }}" />
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($product->description_fr), 150) }}" />
    <meta name="twitter:image" content="{{ asset('storage/' . $product->media->first()->url) }}" />
    <meta name="twitter:card" content="summary_large_image" />
@endsection
<div>
    <section class="sections-bg-gradient container-fluid" id="product-detail" style="padding: 100px 0;">
        <div class="container">


            <div class="row">
                {{-- Left: Fixed size big image + thumbnails --}}
                <div class="col-lg-6 mb-4">
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
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h2 class="text-black fw-bold mb-3">{{ $product->{'name_' . $language} }}</h2>
                    <p class="text-muted mb-4" style="line-height: 1.4;">
                        {{ $product->{'description_' . $language} }}
                    </p>
                    <h3 class="text-success fw-bold mb-4">{{ number_format($product->price, 2) }}
                        {{ __('Currency') }}
                    </h3>
                    @if ($product->category->name_fr == 'Rideaux')
                        <a href="#contact" class="btn btn-lg fw-bold px-2 py-1 position-relative overflow-hidden"
                            style="
                                display: inline-block;
                                background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%);
                                border: 2px solid #b8941f;
                                color: #2c2c2c;
                                border-radius: 50px;
                                transition: all 0.3s ease;
                                box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
                                text-decoration: none;
                        "
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(212, 175, 55, 0.4)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(212, 175, 55, 0.3)'">
                            <span class="d-flex align-items-center justify-content-center">
                                <span class="me-2">📞</span>
                                {{ 'Contact Us' }}
                            </span>
                        </a>
                    @endif
                    @if ($product->category->name_fr != 'Rideaux')
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
                                    <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
                                    <span class="text-muted small">({{ __('optional') }})</span>
                                    <input type="email" placeholder="{{ __('Email') }}" id="email"
                                        wire:model.live="email" class="form-control">
                                    @error('email')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label fw-semibold">{{ __('Quantity') }}</label>
                                    <input type="number" id="quantity" placeholder="{{ __('Quantity') }}"
                                        wire:model.live="quantity" min="1" class="form-control">
                                    @error('quantity')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if ($quantity && $product->category->name_fr == 'La Rail')
                                    <div class="col-md-12">
                                        <h5 class="fw-bold">{{ __('Enter Dimensions') }} : </h5><small
                                            class="ms-2">({{ __('The entered value will be rounded to the nearest standard dimension') }})</small>
                                        @foreach ($dimensions as $index => $dim)
                                            <div class="row g-2 align-items-end mb-2">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Room #"
                                                        value="{{ __('Room') }} {{ $index + 1 }}" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number"
                                                        wire:model.live="dimensions.{{ $index }}.largeur"
                                                        min="0.01" step="0.01"class="form-control"
                                                        placeholder="{{ __('Largeur') }} ({{ __('metre') }})">
                                                    @error('dimensions.' . $index . '.largeur')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">{{ __('Type of Delivery') }}</label>
                                    <div class="d-flex gap-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                wire:model.live="deliveryType" id="domicile" value="0">
                                            <label class="form-check-label" for="domicile">🏠
                                                {{ __('Domicile') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                wire:model.live="deliveryType" id="stopdesk" value="1">
                                            <label class="form-check-label" for="stopdesk">🚗
                                                {{ __('Stopdesk') }}</label>
                                        </div>
                                    </div>
                                    @error('deliveryType')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">{{ __('State') }}</label>
                                    <select wire:model.live="selectedState" class="form-select">
                                        <option value="">{{ __('Choose state') }}</option>
                                        @foreach ($this->states as $state)
                                            <option value="{{ $state->id }}">
                                                {{ $state->{$language . '_name'} }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('selectedState')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if (!$this->deliveryType)
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">{{ __('City') }}</label>
                                        <select wire:model.live="selectedCity" class="form-select">
                                            <option value="">{{ __('Choose city') }}</option>
                                            @foreach ($this->cities as $city)
                                                <option value="{{ $city->id }}">
                                                    {{ $city->{$language . '_name'} }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('selectedCity')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                @if ($this->deliveryPrice && $this->productPrice)
                                    <div class="col-md-12">
                                        <p class="fw-semibold mt-3">{{ __('Product Price') }}:
                                            <span class="text-primary">{{ number_format($this->productPrice, 2) }}
                                                {{ __('Currency') }}</span>
                                        </p>
                                        <p class="fw-semibold mt-3">{{ __('Delivery Price') }}:
                                            <span class="text-primary">{{ number_format($this->deliveryPrice, 2) }}
                                                {{ __('Currency') }}</span>
                                        </p>
                                        <p class="fw-bold">{{ __('Total Price') }}:
                                            <span
                                                class="text-success">{{ number_format($this->productPrice + $this->deliveryPrice, 2) }}
                                                {{ __('Currency') }}</span>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success btn-lg w-100 fw-bold mt-4"><span
                                    wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                {{ __('Order Now') }}

                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="sections-bg-gradient container-fluid py-5">
        <div class="container">

            <h2 class="section-heading text-center mb-4" style="font-size: 25px;">
                {{ __('Related Products') }}
                <span class="heading-border-bottom" style="left: 0%; transform: none;"></span>
            </h2>
            <div id="relatedProductsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($this->relatedProducts as $index => $product)
                        @if ($index % 3 === 0)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="row justify-content-center">
                        @endif

                        <div class="col-md-4 mb-3">
                            <a href="{{ route('client.product.show', $product->id) }}"
                                class="text-decoration-none text-black">

                                <div class="card shadow-sm rounded-4 border-0 h-100">
                                    <img src="{{ asset('storage/' . $product->media->first()->url) }}"
                                        class="related-products-img rounded-top-4"
                                        alt="{{ $product->{'name_' . $language} }}">
                                    <div class="card-body text-end d-flex flex-column">
                                        <h5 class="card-title">{{ $product->{'name_' . $language} }}</h5>
                                        <p class="card-text text-muted small mb-2">
                                            {{ Str::limit($product->{'description_' . $language}, 10) }}
                                        </p>
                                        <p class="fw-bold text-success fs-6 mt-auto">
                                            {{ number_format($product->price, 2) }} {{ __('Currency') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>


                        @if (($index + 1) % 3 === 0 || $loop->last)
                </div>
            </div>
            @endif
            @endforeach
        </div>

        @if ($this->relatedProducts->count() > 3)
            <button class="carousel-control-prev" type="button" data-bs-target="#relatedProductsCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('Previous') }}</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#relatedProductsCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('Next') }}</span>
            </button>
        @endif
</div>
</div>
</section>

</div>
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
