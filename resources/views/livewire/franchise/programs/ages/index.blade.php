<div class="container-fluid p-0 mt-3">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">{{ __('Age Ranges') }}</h1>
    </div>
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between mb-4">
            <h5 class="card-title mb-0">{{ __('Available age ranges') }}</h5>
            <button type="button" class="btn btn-primary" tabindex="0"
                data-bs-toggle="modal" data-bs-target="#add-edit-age"
                wire:click.prevent="$dispatch('set-age-range', { action: 'Add', ageRange: null })"
                aria-controls="datatables-buttons"><span>{{ __('Add age range') }}</span>
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
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Age Range') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th class="text-end">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->ageRanges as $range)
                                    <tr>
                                        <th scope="row" style="color: #666666;">{{ $range->name }}</th>
                                        <td>[{{ $range->min_age }} -
                                            @if (isset($range->max_age)) {{ $range->max_age }}]
                                            @else ∞[ @endif
                                        </td>
                                        <td>{{ __('DA', ['price' => $range->price]) }}</td>
                                        <td class="text-end">
                                            <button data-bs-toggle="modal" data-bs-target="#add-edit-age"
                                                wire:click="$dispatch('set-age-range', { action: 'Edit', ageRange: {{ $range->id }} })"
                                                class="btn btn-primary btn-sm">{{ __('Edit') }}</button>
                                            <button class="btn btn-danger btn-sm" type="button"
                                                wire:click="$dispatch('delete-confirmation', { function:'delete', id: {{ $range->id }} })">
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    @include('components.empty-table', [
                                        'message' => __('No age range has been found'),
                                        'colspan' => 4,
                                    ])
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $this->ageRanges->links() }}
                </div>
            </div>
        </div>
    </div>

    @livewire('franchise.programs.ages.modal', ['program' => $program->id])
</div>
