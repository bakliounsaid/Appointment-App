<main class="content">

    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Calandar') }}</h1>
        </div>
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">

                <h5 class="card-title mb-0">{{ __('Calandar') }} ({{ __('From') }}: {{ $nextSevenDays[0]['date'] }} {{ __('To') }}: {{ $nextSevenDays[6]['date'] }})</h5>


            </div>

            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row dt-row">
                        <div class="col-sm-12">
                            <table class="table table-striped no-footer dtr-inline" width="100%" style="width: 100%; border-collapse: collapse;">
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
                                                @if (isset($this->validated[$day['date']]) && $this->validated[$day['date']]->isNotEmpty())
                                                    <ul>
                                                        @foreach ($this->validated[$day['date']] as $appointment)
                                                            <li>
                                                                {{ $appointment->name }} <br>
                                                                {{ $appointment->city->{$language.'_name'} }} ({{ $appointment->city->state->{$language.'_name'} }}) <br>
                                                                {{ $appointment->phone }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
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
</main>

