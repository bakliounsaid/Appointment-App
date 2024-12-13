<div class="container-fluid p-0 mt-3">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">{{ __('Services') }}</h1>
    </div>
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between mb-4">
            <h5 class="card-title mb-0">{{ __('Available services') }}</h5>
            <button type="button" class="btn btn-primary" tabindex="0"
                data-bs-toggle="modal" data-bs-target="#add-edit-service"
                wire:click.prevent="$dispatch('set-service', { action: 'Add', service: null })"
                aria-controls="datatables-buttons"><span>{{ __('Add service') }}</span>
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
                    <div class="col-sm-12 col-md-3">
                        <div class="dataTables_length">
                            <label>{{ __('Type') }}:
                                <select wire:model.live="type" class="form-select form-select-sm">
                                    <option value="">{{ __('Service Type') }}</option>
                                    @foreach ($this->types as $type)
                                        <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
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
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('For client and companions') }}</th>
                                    <th class="text-end">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->services as $service)
                                    <tr>
                                        <th scope="row" style="color: #666666;">{{ $service->name }}</th>
                                        <td>{{ Str::limit($service->description, 50, preserveWords: true) }}</td>
                                        <td>{{ __('DA', ['price' => $service->price]) }}</td>
                                        <td>{{ __($service->type) }}</td>
                                        <td>{{ __($service->for_client_and_related ? "Yes" : "No") }}</td>
                                        <td class="text-end">
                                            <button data-bs-toggle="modal" data-bs-target="#add-edit-service"
                                                wire:click="$dispatch('set-service', { action: 'Edit', service: {{ $service->id }} })"
                                                class="btn btn-primary btn-sm">{{ __('Edit') }}</button>
                                            <button class="btn btn-danger btn-sm" type="button"
                                                wire:click="$dispatch('delete-confirmation', { function:'delete', id: {{ $service->id }} })">
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    @include('components.empty-table', [
                                        'message' => __('No service has been found'),
                                        'colspan' => 5,
                                    ])
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $this->services->links() }}
                </div>
            </div>
        </div>
    </div>

    @livewire('franchise.programs.services.modal', ['program' => $program->id])
</div>
