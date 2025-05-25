<main class="content">

    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Products') }}</h1>
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">

                <h5 class="card-title mb-0">{{ __('Our Products') }}</h5>
                <div class="card-actions ">
                    <a class="btn btn-primary text-white" href="{{ route('admin.product.create') }}" tabindex="0"
                        aria-controls="datatables-buttons" type="button">
                        <span>{{ __('Add New Product') }}</span>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length">
                                <label>{{ __('Show') }}
                                    <select wire:model.live="paginate" class="form-select form-select-sm"
                                        name="paginate">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> {{ __('entries') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_filter">
                                <label>{{ __('Search') }}:
                                    <input type="search" wire:model.live="search" class="form-control form-control-sm"
                                        placeholder="{{ __('Search') }}" name="search">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row dt-row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped no-footer dtr-inline" width="100%"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Name_Ar') }}</th>
                                            <th>{{ __('Name_Fr') }}</th>
                                            <th> {{ __('Description_Ar') }} </th>
                                            <th> {{ __('Description_Fr') }} </th>
                                            <th> {{ __('Price') }}</th>
                                            <th> {{ __('Available') }}</th>
                                            <th class="text-end">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($products->count())
                                            @foreach ($products as $product)
                                                <tr>
                                                    <th><img src="{{ asset('storage/' . $product->media->first()->url) }}"
                                                            width='40'style='margin-inline-start: 5px;' /></th>
                                                    <td>{{ $product->name_ar }}</td>
                                                    <td>{{ $product->name_fr }} </td>
                                                    <td>{{ $product->description_ar }}</td>
                                                    <td>{{ $product->description_fr }}</td>
                                                    <td>{{ number_format($product->price, 2) }} {{ __('Currency') }}</td>
                                                    <td>
                                                        @if ($product->available)
                                                            <span class="text-success">{{ __('Yes') }}</span>
                                                        @else
                                                            <span class="text-danger">{{ __('No') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="{{ route('admin.product.show', $product->id) }}"
                                                            class="btn btn-primary btn-sm">{{ __('Show') }}
                                                        </a>
                                                        <button class="btn btn-danger btn-sm" type="button"
                                                            wire:click="$dispatch('delete-confirmation', { function:'delete',id: {{ $product->id }},
                                                      text: '{{ __('delete_product_warning') }}'})">
                                                            {{ __('Delete') }}
                                                        </button>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @include('components.empty-table', [
                                                'message' => __('No Products has been found'),
                                                'colspan' => 8,
                                            ])
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($products->count())
                            {{ $products->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
