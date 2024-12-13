{{-- If your happiness depends on money, you will never be happy with yourself. --}}
<main class="content">

    <div class="container-fluid p-0">
        <div class="mb-3">
            {{ Breadcrumbs::render('franchise.flights.index') }}
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">

                <h5 class="card-title mb-0">{{ __('Flights') }}</h5>
                <div class="card-actions ">
                    <a class="btn btn-primary text-white" href="{{ route('franchise.flights.create') }}" tabindex="0"
                        aria-controls="datatables-buttons" type="button">
                        <span>{{ __('Add New flights') }}</span>
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
                                        <th>{{ __('Flight number') }}</th>
                                        <th>{{ __('Number places') }}</th>
                                        <th>{{ __('Remaining places') }}</th>
                                        <th>{{ __('Departure date') }}</th>
                                        <th>{{ __('Arrival date') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Estimated departure time') }}</th>
                                        <th>{{ __('Estimated arrival time') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($flights->count())
                                        @foreach ($flights as $flight)
                                            <tr>
                                                <td>{{ $flight->flight_number }}</td>
                                                <td>{{ $flight->nb_places }}</td>
                                                <td>{{ $flight->remaining_places }}</td>
                                                <td>{{ $flight->departure_date }}</td>
                                                <td>{{ $flight->arrival_date }}</td>
                                                <td>{{ $flight->type }}</td>
                                                <td>{{ $flight->estimated_departure_time }}</td>
                                                <td>{{ $flight->estimated_arrival_time }}</td>
                                                <td class="text-end">
                                                    <a href="{{route('franchise.flights.edit',$flight->id)}}"
                                                        class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                        wire:click="$dispatch('delete-confirmation', { function:'delete',id: {{ $flight->id }},
                                                           text: '{{ __('delete_flight_warning') }}' })">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @include('components.empty-table', [
                                            'message' => __('No flight has been found'),
                                            'colspan' => 9,
                                        ])
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if ($flights->count())
                            {{ $flights->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
