<section class="sections-bg-gradient container-fluid" id="products" style="padding: 100px 0;">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="text-black section-heading">
                    {{ __('Our Products') }}
                    <span class="heading-border-bottom"></span>
                </h2>
                <p>{{ __('discover_products') }}</p>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <input type="text" name="search" wire:model.live="search"
                        class="form-control shadow rounded-4 py-3" placeholder="{{ __('search_products') }}">
                </div>
            </div>
        </div>



        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 rounded-4">

                        {{-- Bootstrap Carousel for product images --}}
                        <div id="carouselProduct{{ $product->id }}" class="carousel slide rounded-top-4"
                            data-bs-ride="carousel" data-bs-interval="3000">
                            <div class="carousel-inner ratio ratio-4x3">
                                @foreach ($product->media as $key => $media)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $media->url) }}"
                                            class="d-block w-100 object-fit-cover" alt="{{ $product->name_ar }}">
                                    </div>
                                @endforeach
                            </div>
                            @if ($product->media->count() > 1)
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselProduct{{ $product->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">{{ __('Previous') }}</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselProduct{{ $product->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">{{ __('Next') }}</span>
                                </button>
                            @endif
                        </div>

                        {{-- Product info --}}
                        <div class="card-body d-flex flex-column p-3">
                            <h6 class="card-title text-black fw-bold mb-1 fs-6">{{ $product->name_ar }}</h6>
                            <p class="card-text text-muted small mb-2" style="line-height: 1.2;">
                                {{ Str::limit($product->{'description_' . $language}, 10) }}
                            </p>
                            <div class="mt-auto">
                                <p class="fw-bold text-success fs-6 mb-2">
                                    {{ number_format($product->price, 2) }} {{ __('Currency') }}
                                </p>
                                <a href="{{ route('client.product.show', $product->id) }}"
                                    class="btn bg-success text-white w-100 btn-sm fw-bold">
                                    {{ __('See Details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-info rounded-4 py-4">
                        {{ __('no_products') }}
                    </div>
                </div>
            @endforelse
        </div>
        @if ($products->count())
            {{ $products->links() }}
        @endif
    </div>
</section>
