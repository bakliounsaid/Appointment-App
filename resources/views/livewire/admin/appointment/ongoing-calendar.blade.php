<main class="content">

    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Assembly Calendar') }}</h1>
        </div>
        <div class="card" id="printCard">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">

                <h5 class="card-title mb-0">{{ __('Calandar') }} ({{ __('From') }}: {{ $nextSevenDays[0]['date'] }}
                    {{ __('To') }}: {{ $nextSevenDays[6]['date'] }})</h5>

            </div>

            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row dt-row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped  table-bordered table-hover no-footer dtr-inline"
                                    width="100%" style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            @foreach ($nextSevenDays as $day)
                                                <th class="border-cell">{{ $day['day'] }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($nextSevenDays as $day)
                                                <td class="border-cell">
                                                    @if (isset($this->ongoing[$day['date']]) && $this->ongoing[$day['date']]->isNotEmpty())
                                                        <ol class="m-0 p-0"
                                                            style="list-style-position: inside; font-size: 14px;">
                                                            @foreach ($this->ongoing[$day['date']] as $appointment)
                                                                <li
                                                                    style="padding-bottom: 10px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">
                                                                    <a href="{{ route('admin.appointments.show', $appointment->id) }}"
                                                                        style="text-decoration: none; color: inherit;">
                                                                        <strong>{{ $appointment->name }}</strong> -
                                                                        {{ $appointment->city->{$language . '_name'} }},
                                                                        {{ $appointment->city->state->{$language . '_name'} }}
                                                                        -
                                                                        {{ $appointment->phone }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    @else
                                                        <p class="text-muted text-center m-0">
                                                            {{ __('No appointments') }}</p>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>
