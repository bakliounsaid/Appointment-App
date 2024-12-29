<div>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{ route('admin.dashboard') }}" wire:navigate>
                <span class="align-middle">{{ __('Admin') }}</span>
            </a>

            <ul class="sidebar-nav {{ app()->getLocale() === 'ar' ? 'fc-direction-rtl' : '' }}">
                <li class="sidebar-item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" wire:navigate>
                        <i class="align-middle" data-feather="sliders"></i>
                        <span class="align-middle">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.appointments.pending') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.appointments.pending') }}">
                        <i class="align-middle" data-feather="book"></i>
                        <span class="align-middle">{{ __('Pending Appointments') }}</span>
                        <span class="badge badge-warning position-absolute"
                        style="color:orange">({{ $this->pending }})</span>

                    </a>


                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.appointments.validated') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.appointments.validated') }}">
                        <i class="align-middle" data-feather="bookmark"></i>
                        <span class="align-middle">{{ __('Comfirmed Appointments') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.appointments.ongoing') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.appointments.ongoing') }}">
                        <i class="align-middle" data-feather="award"></i>
                        <span class="align-middle">{{ __('Ongoing Commands') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.appointments.archived') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.appointments.archived') }}">
                        <i class="align-middle" data-feather="archive"></i>
                        <span class="align-middle">{{ __('Archived Commands') }}</span>
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
            </ul>
        </div>
    </nav>
</div>
