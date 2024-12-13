<main class="content">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="container-fluid p-0">
        <div class="mb-3">
            {{ Breadcrumbs::render('franchise.programs.index') }}
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">

                <h5 class="card-title mb-0">{{ __('Programs') }}</h5>
                <div class="card-actions ">
                    <a class="btn btn-primary text-white" href="{{route('franchise.programs.create')}}" tabindex="0" aria-controls="datatables-buttons"
                        type="button">
                        <span>{{ __('Add program') }}</span>
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
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Places number') }}</th>
                                        <th>{{ __('Start date') }}</th>
                                        <th>{{ __('End date') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($programs->count())
                                        @foreach ($programs as $program)
                                            <tr>
                                                <th>{{ $program->title }}</th>
                                                <td>{{ $program->nb_places }}</td>
                                                <td>{{ $program->start_date }}</td>
                                                <td>{{ $program->end_date }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('franchise.programs.show', $program) }}"
                                                        class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                        wire:click="$dispatch('delete-confirmation', { function:'delete',id: {{ $program->id }} })">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @include('components.empty-table', [
                                            'message' => __('No program has been found'),
                                            'colspan' => 5,
                                        ])
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if ($programs->count())
                            {{ $programs->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
