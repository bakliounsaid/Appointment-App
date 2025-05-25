<main class="content">

    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Orders') }}</h1>
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">

                <h5 class="card-title mb-0">{{ __('Our Orders') }}</h5>
                <div class="card-actions">
                    <button class="btn btn-primary text-white" wire:click="refresh" tabindex="0"
                        aria-controls="datatables-buttons" type="button">
                        <span wire:loading wire:target="refresh" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                        <i data-feather="refresh-cw" class="me-1"></i>
                        {{ __('Refresh') }}
                    </button>
            </div>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length">
                            <label>{{ __('Show') }}
                                <select wire:model.live="paginate" class="form-select form-select-sm" name="paginate">
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
                            <table class="table table-striped no-footer dtr-inline" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Name') }}</th>
                                        <th> {{ __('Phone') }} </th>
                                        <th> {{ __('City') }}</th>
                                        <th> {{ __('State') }}</th>
                                        <th> {{ __('Delivery Method') }}</th>
                                        <th> {{ __('Price') }}</th>
                                        <th> {{ __('Status') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orders->count())
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->fullname }}</td>
                                                <td>{{ $order->client_phone }}</td>
                                                <td>{{ $order->city->{$language . '_name'} }}</td>
                                                <td>{{ $order->city->state->{$language . '_name'} }}</td>
                                                <td>{{ $order->deliveryType }}</td>
                                                <td>{{ number_format($order->total, 2) }} {{ __('Currency') }}</td>
                                                <td>
                                                    <span class="badge {{ $order->latestStatus->status->class }}">
                                                        {{ __($order->latestStatus->status->name) }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.order.show', $order->id) }}"
                                                        class="btn btn-primary btn-sm">{{ __('Show') }}
                                                    </a>
                                                    @if(in_array($order->latestStatus->status->name ,["Pending","Ongoing"]))
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                        wire:click="$dispatch('delete-confirmation', { function:'delete',id: {{ $order->id }},
                                                      text: '{{ __('delete_order_warning') }}'})">
                                                        {{ __('Delete') }}
                                                    </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @include('components.empty-table', [
                                            'message' => __('No Orders has been found'),
                                            'colspan' => 8,
                                        ])
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($orders->count())
                        {{ $orders->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
