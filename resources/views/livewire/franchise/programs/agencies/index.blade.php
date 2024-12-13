<div class="container-fluid p-0 mt-3">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">{{ __('Agencies') }}</h1>
    </div>
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between mb-4">
            <h5 class="card-title mb-0">{{ __('Franchise Agencies') }}</h5>
            <button type="button" class="btn btn-primary" tabindex="0"
                data-bs-toggle="modal" data-bs-target="#add-edit-agency"
                wire:click.prevent="$dispatch('set-agency', { action: 'Add', agency: null })"
                aria-controls="datatables-buttons"><span>{{ __('Attach agency') }}</span>
            </button>
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

                <div class="row dt-row">
                    <div class="col-sm-12">
                        <table class="table table-striped no-footer dtr-inline" width="100%" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>{{ __('Logo') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th >{{ __('Phone number 1') }}</th>
                                    <th>{{ __('Phone number 2') }}</th>
                                    <th>{{ __('Agency Gain') }}</th>
                                    <th class="text-end">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->agencies as $agency)
                                    <tr>
                                        <th><img src="{{ asset('storage/' . $agency->logo) }}"
                                            width='40'style='margin-inline-start: 5px;'/></th>
                                        <td>{{ $agency->name }}</td>
                                        <td>{{ $agency->email }}</td>
                                        <td>
                                            <img src="{{ asset('vendor/blade-flags/country-' . strtolower(getPhoneCountry($agency->phone_code1)) . '.svg') }}"
                                            width='20' style='margin-inline-start: 5px;' />
                                            {{ '+' . $agency->phone_code1 . ' ' . $agency->phone1 }}</td>
                                        <td>
                                            @if ($agency->phone2)
                                                @if ($agency->phone_code2)
                                                    <img src="{{ asset('vendor/blade-flags/country-' . strtolower(getPhoneCountry($agency->phone_code2)) . '.svg') }}"
                                                    width="20" style="margin-inline-start: 5px;" />
                                                    {{ '+' . $agency->phone_code2 . ' ' . $agency->phone2 }}
                                                @endif
                                            @else
                                                /
                                            @endif
                                        </td>
                                        <td>{{ __('DA', ['price' => $agency->pivot->agency_gain]) }}</td>
                                        <td class="text-end">
                                            <button data-bs-toggle="modal" data-bs-target="#add-edit-agency"
                                                wire:click="$dispatch('set-agency', { action: 'Edit', agency: {{ $agency->id }} })"
                                                class="btn btn-primary btn-sm">{{ __('Edit') }}</button>
                                            <button class="btn btn-danger btn-sm" type="button"
                                                wire:click="$dispatch('delete-confirmation', { function:'delete', id: {{ $agency->id }} })">
                                                {{ __('Detach') }}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    @include('components.empty-table', [
                                        'message' => __('No agency has been found'),
                                        'colspan' => 6,
                                    ])
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $this->agencies->links() }}
                </div>
            </div>
        </div>
    </div>

    @livewire('franchise.programs.agencies.modal', ['program' => $program->id])
</div>
