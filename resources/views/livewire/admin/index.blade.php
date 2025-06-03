<main class="content">

    <div class="container-fluid p-0">
        <div class="mb-3 d-flex justify-content-end">
            <select id="quotationFilter" class="form-select w-auto" wire:model.live="quotationFilter">
                <option value="today">{{ __('Today') }}</option>
                <option value="last_7_days">{{ __('Last 7 Days') }}</option>
                <option value="this_month">{{ __('This Month') }}</option>
                <option value="last_month">{{ __('Last Month') }}</option>
                <option value="this_year">{{ __('This Year') }}</option>
                <option value="last_year">{{ __('Last Year') }}</option>
            </select>
        </div>

        <h1 class="h3 mb-3"><strong>{{ __('Appointments Statistic') }}</strong></h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">{{ __('Pending Appointments') }}</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="book"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $this->pending }}</h1>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">{{ __('Ongoing Commands') }}</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="award"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $this->ongoing }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">{{ __('Confirmed Appointments') }}</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="bookmark"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $this->validated }}</h1>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">{{ __('Quotations') }}</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">
                            <td>{{ number_format($this->quotationAppointment, 2) }} {{ __('Currency') }}</td>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Product & Order Stat -->
        <h1 class="h3 mt-4 mb-3"><strong>{{ __('Order Statistic') }}</strong></h1>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">{{ __('Pending Orders') }}</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-success">
                                    <i class="align-middle" data-feather="box"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $this->pendingOrders }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">{{ __('Quotations') }}</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">
                            <td>{{ number_format($this->quotationOrder, 2) }} {{ __('Currency') }}</td>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
