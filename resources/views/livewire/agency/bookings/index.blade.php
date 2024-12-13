<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            {{ Breadcrumbs::render('agency.bookings.index') }}
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">
                <h5 class="card-title mb-0">{{ __('Bookings') }}</h5>
                <div class="card-actions ">
                    <a class="btn btn-primary text-white" href="{{ route('agency.bookings.create') }}" tabindex="0"
                        aria-controls="datatables-buttons" type="button">
                        <span>{{ __('Add booking') }}</span>
                    </a>
                </div>
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
                                    <input type="search" wire:model.live="search"
                                    class="form-control form-control-sm">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4">
                            <div class="dataTables_filter">
                                <label>{{ __('Booking start date') }}:
                                    <input type="date" wire:model.live="bookingStartDate"
                                    class="form-control form-control-sm">
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="dataTables_filter">
                                <label>{{ __('Booking end date') }}:
                                    <input type="date" wire:model.live="bookingEndDate"
                                    class="form-control form-control-sm">
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="dataTables_length">
                                <label>{{ __('Payment status') }}:
                                    <select wire:model.live="paymentStatus" class="form-select form-select-sm">
                                        <option value="">{{ __('All payments') }}</option>
                                        <option value="{{ \App\Models\Payment::PAID }}">{{ __('PAID') }}</option>
                                        <option value="{{ \App\Models\Payment::NOT_PAID }}">{{ __('NOT_PAID') }}</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4">
                            <div class="dataTables_filter">
                                <label>{{ __('Program start date') }}:
                                    <input type="date" wire:model.live="programStartDate"
                                    class="form-control form-control-sm">
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="dataTables_filter">
                                <label>{{ __('Program end date') }}:
                                    <input type="date" wire:model.live="programEndDate"
                                    class="form-control form-control-sm">
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="dataTables_length">
                                <button type="button" class="btn btn-info text-white"
                                    wire:loading.attr="disabled" wire:click="clearFilters">
                                    <span wire:loading wire:target="clearFilters" class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true" style="margin-inline-end: 0.25rem;"></span>
                                    {{ __('Clear filters') }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="row dt-row">
                        <div class="col-sm-12">
                            <table class="table table-striped no-footer dtr-inline" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Client') }}</th>
                                        <th>{{ __('Program') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th>{{ __('Payment status') }}</th>
                                        <th>{{ __('Date of booking') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->programBookings as $booking)
                                        <tr>
                                            <td><a href="">{{ $booking->booking->user->name }}
                                                @if ($booking->count_relateds) <br>& {{ $booking->count_relateds }} {{ __('Companions') }} @endif</a></td>
                                            <td><a href="">{{ $booking->program->title }}</a></td>
                                            <td>{{ __('DA', ['price' => $booking->total]) }}</td>
                                            <td><span class="badge text-bg-{{ \App\Models\Payment::getBadge($booking->latestPayment?->status) }}">
                                                {{ __($booking->latestPayment?->status ?? \App\Models\Payment::NOT_PAID) }}</span></td>
                                            <td>{{ $booking->created_at }}</td>
                                            <td class="text-end">
                                                {{-- <button data-bs-toggle="modal" data-bs-target="#add-edit-booking"
                                                    wire:click="$dispatch('set-booking', { action: 'Edit', booking: {{ $booking->id }} })"
                                                    class="btn btn-primary btn-sm">{{ __('Edit') }}</button> --}}
                                                <button class="btn btn-danger btn-sm" type="button"
                                                    wire:click="$dispatch('delete-confirmation', { function:'delete', id: {{ $booking->id }} })">
                                                    {{ __('Delete') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        @include('components.empty-table', [
                                            'message' => __('No booking has been found'),
                                            'colspan' => 6,
                                        ])
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $this->programBookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
