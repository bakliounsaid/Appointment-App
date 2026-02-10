<div>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{ route('admin.dashboard') }}" wire:navigate>
                <span class="align-middle">{{ __('Admin') }}</span>
            </a>
            <ul class="sidebar-nav {{ app()->getLocale() === 'ar' ? 'fc-direction-rtl' : '' }}">
                <!-- Dashboard Section -->
                <li class="sidebar-header">{{ __('Dashboard') }}</li>
                <li class="sidebar-item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" wire:navigate>
                        <i class="align-middle" data-feather="sliders"></i>
                        <span class="align-middle">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <!-- Appointment Section -->
                <li class="sidebar-header">{{ __('Appointments') }}</li>
                <li class="sidebar-item {{ request()->routeIs('admin.appointments.pending') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.appointments.pending') }}">
                        <i class="align-middle" data-feather="book"></i>
                        <span class="align-middle">{{ __('Pending Appointments') }}</span>
                        <span class="badge badge-warning position-absolute"
                            style="color: blue">({{ $this->pending }})</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.appointments.validated') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.appointments.validated') }}">
                        <i class="align-middle" data-feather="bookmark"></i>
                        <span class="align-middle">{{ __('Confirmed Appointments') }}</span>
                         <span class="badge badge-warning position-absolute"
                            style="color:orange">({{ $this->confirmed }})</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.appointments.ongoing') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.appointments.ongoing') }}">
                        <i class="align-middle" data-feather="award"></i>
                        <span class="align-middle">{{ __('Ongoing Commands') }}</span>
                         <span class="badge badge-warning position-absolute"
                            style="color: green">({{ $this->ongoing }})</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.appointments.archived') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.appointments.archived') }}">
                        <i class="align-middle" data-feather="archive"></i>
                        <span class="align-middle">{{ __('Archived Commands') }}</span>
                         <span class="badge badge-warning position-absolute"
                            style="color: grey">({{ $this->archived }})</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.program') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.program') }}">
                        <i class="align-middle" data-feather="calendar"></i>
                        <span class="align-middle">{{ __('Appointment Calendar') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.calendar') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.calendar') }}">
                        <i class="align-middle" data-feather="calendar"></i>
                        <span class="align-middle">{{ __('Assembly Calendar') }}</span>
                    </a>
                </li>

                <!-- Orders & Products Section -->
                <li class="sidebar-header">{{ __('Orders & Products') }}</li>


                <li class="sidebar-item {{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.order.index') }}">
                        <i class="align-middle" data-feather="shopping-cart"></i>
                        <span class="align-middle">{{ __('Orders') }}</span>
                        <span class="badge badge-warning position-absolute"
                            style="color:green">({{ $this->orders }})</span>

                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.category.index') }}">
                        <i class="align-middle" data-feather="tag"></i>
                        <span class="align-middle">{{ __('Category') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.product.index') }}">
                        <i class="align-middle" data-feather="layers"></i>
                        <span class="align-middle">{{ __('Products') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</div>
