<main class="content">

    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Categories') }}</h1>
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">

                <h5 class="card-title mb-0">{{ __('Our Categories') }}</h5>
                <div class="card-actions ">
                    <a class="btn btn-primary text-white" href="{{ route('admin.category.create') }}" tabindex="0"
                        aria-controls="datatables-buttons" type="button">
                        <span>{{ __('Add New Category') }}</span>
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
                            <div class="table-responsive">
                                <table class="table table-striped no-footer dtr-inline" width="100%"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name_Ar') }}</th>
                                            <th>{{ __('Name_Fr') }}</th>
                                            <th class="text-end">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($categories->count())
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->name_ar }}</td>
                                                    <td>{{ $category->name_fr }} </td>
                                                    <td class="text-end">
                                                        <a href="{{ route('admin.category.show', $category->id) }}"
                                                            class="btn btn-primary btn-sm">{{ __('Show') }}
                                                        </a>
                                                        <button class="btn btn-danger btn-sm" type="button"
                                                            wire:click="$dispatch('delete-confirmation', { function:'delete',id: {{ $category->id }},
                                                      text: '{{ __('delete_category_warning') }}'})">
                                                            {{ __('Delete') }}
                                                        </button>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @include('components.empty-table', [
                                                'message' => __('No Categories has been found'),
                                                'colspan' => 8,
                                            ])
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($categories->count())
                            {{ $categories->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
