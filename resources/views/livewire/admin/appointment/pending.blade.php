<main class="content">

    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Appointments') }}</h1>
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">

                <h5 class="card-title mb-0">{{ __('Appointment') }}</h5>
                <div class="card-actions ">
                    <a class="btn btn-primary text-white" href="{{ route('admin.appointments.pending') }}" tabindex="0" aria-controls="datatables-buttons"
                        type="button">
                        <span>{{ __('Add New Appointment') }}</span>
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
                                        <th>{{ __('Full Name') }}</th>
                                        <th> {{ __('Full Name') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($franchises->count())
                                        @foreach ($pending as $appointment)
                                            <tr>
                                                <td>{{ $appointment->firstaname }}</td>
                                                <td>{{ $appointment->lastname }}</td>
                                                <td class="text-end">
                                                    <a href="#"
                                                        class="btn btn-primary btn-sm">{{ __('Edit') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @include('components.empty-table', [
                                            'message' => __('No franchise has been found'),
                                            'colspan' => 6,
                                        ])
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if ($pending->count())
                            {{ $pending->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

