<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            {{ Breadcrumbs::render('franchise.hotels.index') }}
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">
                <h5 class="card-title mb-0">{{ __('Hotels') }}</h5>

                <a class="btn btn-primary" href="{{ route('franchise.hotels.create') }}" wire:navigate tabindex="0"
                    aria-controls="datatables-buttons" type="button">
                    <span>{{ __('Add hotel') }}</span>
                </a>

            </div>

            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length">
                                <label>{{ __('Show') }}
                                    <select wire:model.live="paginate" class="form-select form-select-sm">
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
                                        placeholder="">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row dt-row">
                        <div class="col-sm-12">
                            <table class="table table-striped no-footer dtr-inline" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Hotel Name') }}</th>
                                        <th>{{ __('Chain name') }}</th>
                                        <th>{{ __('Phone') }} 1</th>
                                        <th>{{ __('Phone') }} 2</th>
                                        <th>{{ __('Email') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hotelslist as $hotel)
                                        <tr>
                                            <th scope="row" style="color: #666666;">{{ $hotel->name }}</th>
                                            <td>{{ $hotel->chain_name }}</td>
                                            <td>{{ $hotel->phone1 }}</td>
                                            <td>{{ $hotel->phone2 ?? '/' }}</td>
                                            <td>{{ $hotel->email }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('franchise.hotels.edit', $hotel->id) }}"
                                                    wire:navigate
                                                    class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                                <button class="btn btn-danger btn-sm" type="button"
                                                    wire:click="$dispatch('delete-confirmation', { function:'delete',id: {{ $hotel->id }} })">
                                                    {{ __('Delete') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($hotelslist->count())
                            {{ $hotelslist->links() }}
                        @else
                            @include('components.empty-table', [
                                'message' => __('No hotel has been found'),
                                'colspan' => 6,
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
