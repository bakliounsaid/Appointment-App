<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Order Details') }}</h1>
        </div>

        <div class="card mb-4" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
            <!-- Client Information Section -->
            <div class="card-header d-flex justify-content-between align-items-center"
                style="border-bottom: 1px solid #e9ecef;">
                <h5 class="card-title mb-0">{{ __('Client Information') }}</h5>

                <div class="card-actions d-flex justify-content-end gap-2 flex-wrap">
                    @if ($order->latestStatus->status->name == 'Ongoing' && $order->delivery_service == 'ZR')
                        <button class="btn btn-primary text-white" type="button"
                            wire:click="$dispatch('creation-confirmation', { function:'externService',
                text: '{{ __('cretion_order_in_zr_delivery_service') }}'})"
                            wire:loading.attr="disabled" wire:loading.class="opacity-50">
                          <span wire:loading wire:target="createOrderInDeliveryService" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                 {{ __('InDelivery') }}
                        </button>
                    @elseif ($order->latestStatus->status->name == 'Ongoing' && $order->delivery_service == 'Default')
                        <button class="btn btn-primary text-white" type="button" wire:click="changeStatus('InDelivery')"
                            wire:loading.attr="disabled" wire:loading.class="opacity-50">
                            <span wire:loading wire:target="changeStatus" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                {{ __('InDelivery') }}
                        </button>
                    @endif


                    @if ($order->latestStatus->status->name == 'Pending')
                        <button class="btn bg-warning text-dark" type="button" wire:click="changeStatus('Ongoing')"
                            wire:loading.attr="disabled" wire:loading.class="opacity-50">
                           <span wire:loading wire:target="changeStatus" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                               {{ __('Confirm') }}
                        </button>
                    @endif

                    @if (in_array($order->latestStatus->status->name, ['InDelivery', 'Alert']))
                        <button class="btn bg-warning text-dark" type="button" wire:click="changeStatus('Alert')"
                            wire:loading.attr="disabled" wire:loading.class="opacity-50">
                           <span wire:loading wire:target="changeStatus" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                {{ __('Alert') }}
                        </button>
                        <button class="btn bg-danger text-white" type="button" wire:click="changeStatus('Returned')"
                            wire:loading.attr="disabled" wire:loading.class="opacity-50">
                            <span wire:loading wire:target="changeStatus" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                {{ __('Returned') }}
                        </button>
                        <button class="btn bg-success text-white" type="button" wire:click="changeStatus('Delivered')"
                            wire:loading.attr="disabled" wire:loading.class="opacity-50">
                           <span wire:loading wire:target="changeStatus" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                {{ __('Delivered') }}
                        </button>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <p><strong>{{ __('Name') }} : </strong> {{ $order->fullname }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>{{ __('Phone') }} : </strong> {{ $order->client_phone }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>{{ __('Email') }} : </strong> {{ $order->client_email ?? '/' }}</p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <p><strong>{{ __('City') }} : </strong>
                            {{ !$order->delivery_method ? $order->city->{$language . '_name'} : '/' }}</p>

                    </div>
                    <div class="col-md-4">
                        <p><strong>{{ __('State') }} : </strong> {{ $order->city->state->{$language . '_name'} }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>{{ __('Delivery Method') }} : </strong> {{ $order->deliveryType }}</p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        @if (in_array($order->latestStatus->status->name, ['Ongoing', 'Pending']))
                            <label for="delivery_service"><strong>{{ __('Delivery Service') }} :</strong></label>
                            <select id="delivery_service" wire:model.live="order.delivery_service" class="form-select">
                                <option value="ZR">ZR</option>
                                <option value="Default">Default</option>
                            </select>
                        @else
                            <p><strong>{{ __('Delivery Service') }} : </strong> {{ $order->delivery_service }}</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <p><strong>{{ __('Tracking Code') }} : </strong> {{ $order->tracking_code ?? '/' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>{{ __('Status') }} : </strong><span
                                class="badge {{ $order->latestStatus->status->class }}">
                                {{ __($order->latestStatus->status->name) }}
                            </span></p>
                    </div>
                </div>
            </div>

            <!-- Product Section -->
            <div class="card-header" style="border-top: 1px solid #e9ecef; border-bottom: 1px solid #e9ecef;">
                <h5 class="card-title mb-0">{{ __('Products') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Dimensions') }}({{ __('metre') }})</th>
                            <th>{{ __('Unit Price') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderProduct as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->orderable->{'name_' . $language} }} </td>
                                <td>{{ $product->quantity }}</td>
                                {{-- Dimensions --}}
                                <td>
                                    @if ($product->order->dimension && count($product->order->dimension) > 0)
                                        @foreach ($product->order->dimension as $dim)
                                            <div>
                                                {{ __('Room') }}: {{ $dim->room_number ?? '-' }},
                                                {{ __('Largeur') }}: {{ $dim->largeur ?? '-' }}
                                            </div>
                                        @endforeach
                                    @else
                                        /
                                    @endif
                                </td>
                                <td>{{ number_format($product->sell_price, 2) }} {{ __('Currency') }}</td>
                                <td>{{ number_format($order->totalNoDelivery, 2) }} {{ __('Currency') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>
                <div class="d-flex justify-content-between">
                    <strong>{{ __('Total') }}</strong>
                    <span class="fw-bold">{{ number_format($order->totalNoDelivery, 2) }} {{ __('Currency') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <strong>{{ __('Delivery Fee') }}</strong>
                    <span class="fw-bold">{{ number_format($order->delivery_fees, 2) }} {{ __('Currency') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <strong>{{ __('Final Price') }}</strong>
                    <span class="fw-bold text-success">{{ number_format($order->total, 2) }}
                        {{ __('Currency') }}</span>
                </div>

            </div>
        </div>
    </div>
</main>
