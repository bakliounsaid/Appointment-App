<main class="content">
    <div class="container-fluid p-0">

        <!-- Section 1: Rdv STAT -->
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
                        <h1 class="mt-1 mb-3">{{ $this->weeklyQuotation }} {{ __('Currency') }}</h1>
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
                        <h1 class="mt-1 mb-3">{{ $this->pendingOrders}}</h1>
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
                        <h1 class="mt-1 mb-3">{{ $this->weeklyQuotation }} {{ __('Currency') }}</h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
