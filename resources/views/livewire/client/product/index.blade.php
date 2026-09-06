<section class="sections-bg-gradient container-fluid" id="products" style="padding: 100px 0; background-image: url('{{ asset('images/bg/5.png') }}');">
    <div class="container position-relative z-3">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="section-heading">
                    {{ __('Our Products') }}
                    <span class="heading-border-bottom"></span>
                </h2>
                <p class="fw-bold" style="color: #F5F5F5;">{{ __('discover_products') }}</p>
            </div>

            {{-- Search Input --}}
            <div class="row justify-content-center mb-4">
                <div class="col-md-8 d-flex gap-2">
                    <input type="text" name="searchInput" wire:model.defer="searchTerm"
                        class="form-control shadow rounded-4 py-3"
                        placeholder="{{ __('search_products') }}">
                    <button wire:click="applySearch" class="btn rounded-4 px-4 shadow"
                        style="background-color: #FFD700; color: #000; border: none;">
                        {{ __('Search') }}
                    </button>
                </div>
            </div>
        </div>

        {{-- Category Filters --}}
        <div class="row justify-content-center mb-5">
            <div class="col-auto">
                <div class="d-flex flex-wrap gap-2 justify-content-center">
                    <button
                        class="btn px-4 py-2 rounded-pill fw-bold border-2 category-filter {{ is_null($selectedCategory) ? 'btn-warning text-dark' : 'btn-outline-light' }}"
                        style="border-color: #FFD700; transition: 0.3s;"
                        wire:click="$set('selectedCategory', null)">
                        {{ __('All') }}
                    </button>

                    @foreach ($this->categories as $category)
                        <button
                            class="btn px-4 py-2 rounded-pill fw-bold border-2 category-filter {{ $selectedCategory === $category->id ? 'btn-warning text-dark' : 'btn-outline-light' }}"
                            style="border-color: #FFD700; transition: 0.3s;"
                            wire:click="$set('selectedCategory', {{ $category->id }})">
                            {{ $category->{'name_' . $language} }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Product Grid --}}
        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('client.product.show', $product->id) }}" class="text-decoration-none text-black">
                        <div class="card h-100 border-0 rounded-4">

                            {{-- Product Carousel --}}
                            <div id="carouselProduct{{ $product->id }}" class="carousel slide rounded-top-4"
                                data-bs-ride="carousel" data-bs-interval="3000">
                                <div class="carousel-inner ratio ratio-4x3">
                                    @foreach ($product->media as $key => $media)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $media->url) }}"
                                                class="d-block w-100 h-100"
                                                alt="{{ $product->name_fr }}">
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

                            {{-- Product Info --}}
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title text-black fw-bold mb-1 fs-6">
                                    {{ $product->{'name_' . $language} }}
                                </h6>
                                <p class="card-text text-muted small mb-2" style="line-height: 1.2;">
                                    {{ Str::limit($product->{'description_' . $language}, 10) }}
                                </p>
                                <div class="mt-auto">
                                    <p class="fw-bold text-success fs-6 mb-2">
                                        {{ number_format($product->price, 2) }} {{ __('Currency') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-light">
                    <p>{{ __('No products found.') }}</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($products->count())
            <div class="mt-4 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</section>
