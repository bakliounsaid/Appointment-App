<div>
    {{-- Room List Card --}}
    <div class="container-fluid p-0" id="roomList">
        <div class="card">
            <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">{{ __('Rooms') }}</h5>
                <a href="{{ route('franchise.hotels.room.create', $hotel->id) }}" wire:navigate
                    class="btn btn-primary">{{ __('Create new room') }}</a>
            </div>
            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row dt-row">
                        <div class="col-sm-12">
                            <table id="datatables-rooms"
                                class="table table-responsive table-striped dataTable no-footer dtr-inline"
                                width="100%" aria-describedby="datatables-rooms_info" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 35px;">{{ __('Room Number') }}</th>
                                        <th style="width: 106px;">{{ __('Room Type') }}</th>
                                        <th style="width: 99px;">{{ __('Occupancy') }}</th>
                                        <th style="width: 120px;">{{ __('Status') }}</th>
                                        <th class="text-end" style="width: 99px;">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomslist as $room)
                                        <tr class="@if ($loop->odd) odd @else even @endif">
                                            <td>{{ $room->id }}</td>
                                            <td>{{ $room->type }}</td>
                                            <td>{{ $room->nb_beds }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                                    @if ($room->status === 'Occupied') badge-danger-light
                                                    @elseif ($room->status === 'Vacant')
                                                        badge-success-light
                                                    @elseif ($room->status === 'Maintenance')
                                                        badge-warning-light
                                                    @else
                                                        badge-secondary-light @endif">
                                                    {{ $room->status }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('franchise.hotels.room.edit', ['hotel' => $hotel->id, 'room' => $room->id]) }}"
                                                    class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                                <button class="details-btn btn btn-danger btn-sm "
                                                    data-bs-dismiss="modal"
                                                    wire:click="$dispatch('delete-confirmation', { function:'delete',id: {{ $room->id ?? 0 }}})">
                                                    {{ __('Delete') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($roomslist->count())
                                {{ $roomslist->links() }}
                            @else
                                @include('components.empty-table', [
                                    'message' => __('No Room has been found'),
                                    'colspan' => 6,
                                ])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
