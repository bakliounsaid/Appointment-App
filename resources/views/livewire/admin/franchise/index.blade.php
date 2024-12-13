<main class="content">

    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Franchises') }}</h1>
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">

                <h5 class="card-title mb-0">{{ __('Franchises') }}</h5>
                <div class="card-actions ">
                    <a class="btn btn-primary text-white" href="{{ route('admin.franchises.create') }}" tabindex="0" aria-controls="datatables-buttons"
                        type="button">
                        <span>{{ __('Add New franchise') }}</span>
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
                                        <th>{{ __('Logo') }}</th>
                                        <th> {{ __('Name') }}</th>
                                        <th >{{ __('Email') }}</th>
                                        <th >{{ __('Phone number 1') }}</th>
                                        <th>{{ __('Phone number 2') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($franchises->count())
                                        @foreach ($franchises as $franchise)
                                            <tr>
                                                <th><img src="{{ asset('storage/' . $franchise->logo) }}"
                                                    width='40'style='margin-inline-start: 5px;'/></th>
                                                <td>{{ $franchise->name }}</td>
                                                <td>{{ $franchise->email }}</td>
                                                <td><img src="{{ asset('vendor/blade-flags/country-' . strtolower(getPhoneCountry($franchise->phone_code1)) . '.svg') }}"
                                                    width='20' style='margin-inline-start: 5px;' />
                                                {{ '+' . $franchise->phone_code1 . ' ' . $franchise->phone1 }}</td>
                                                <td>
                                                    @if ($franchise->phone2)
                                                        @if ($franchise->phone_code2)
                                                            <img src="{{ asset('vendor/blade-flags/country-' . strtolower(getPhoneCountry($franchise->phone_code2)) . '.svg') }}" width="20" style="margin-inline-start: 5px;" />
                                                        @endif
                                                        {{ '+' . $franchise->phone_code2 . ' ' . $franchise->phone2 }}
                                                    @else
                                                        /
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.franchises.show', $franchise->id) }}"
                                                        class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                        wire:click="$dispatch('delete-confirmation', { function:'delete',id: {{ $franchise->id }},
                                                          text: '{{ __("delete_franchise_warning") }}'})">
                                                        {{ __('Delete') }}
                                                    </button>
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
                        @if ($franchises->count())
                            {{ $franchises->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

