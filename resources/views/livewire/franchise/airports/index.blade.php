<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            {{ Breadcrumbs::render('franchise.airports.index') }}
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">
                <h5 class="card-title mb-0">{{ __('Airports') }}</h5>
                <div class="card-actions ">
                    <a class="btn btn-primary text-white" href="" tabindex="0" aria-controls="datatables-buttons"
                        type="button">
                        <span>{{ __('Add New Airports') }}</span>
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
                            <table class="table table-striped no-footer dtr-inline" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($airports->count())
                                        @foreach ($airports as $airport)
                                            <tr>
                                                <td>{{ $airport->code }}</td>
                                                <td>{{ $airport->name }}</td>
                                                <td>{{ $airport->type }}</td>
                                                <td class="text-end">
                                                    <a href=""
                                                        class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                        wire:click="$dispatch('delete-confirmation', { function:'delete',id: {{ $airport->id }},
                                                            text: '{{ __('delete_flight_warning') }}' })">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @include('components.empty-table', [
                                            'message' => __('No Airport has been found'),
                                            'colspan' => 4,
                                        ])
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if ($airports->count())
                            {{ $airports->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
