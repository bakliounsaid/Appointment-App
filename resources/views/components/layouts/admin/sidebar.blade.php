<div>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{ route('admin.dashboard') }}" wire:navigate>
                <span class="align-middle">{{__('Admin')}}</span>
            </a>

            <ul class="sidebar-nav @if (\App::currentLocale() == 'ar') fc-direction-rtl @endif">
                <li class="sidebar-item  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" wire:navigate>
                        <i class="align-middle" data-feather="sliders"></i>
                        <span class="align-middle">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                 <li class="sidebar-item @if (request()->routeIs('admin.appointments.pending')) ? active @endif">
                    <a class="sidebar-link" href="{{ route('admin.appointments.pending') }}">
                        <i class="align-middle" data-feather="book"></i>
                        <span class="align-middle">{{ __('Pending Appointments') }}</span>
                        <span class="sidebar-badge badge bg-primary">{{ $this->pending }}</span>
                    </a>
                 </li>
                 <li class="sidebar-item @if (request()->routeIs('admin.appointments.validated')) ? active @endif">
                    <a class="sidebar-link" href="{{ route('admin.appointments.validated') }}">
                        <i class="align-middle" data-feather="bookmark"></i>
                        <span class="align-middle">{{ __('Comfirmed Appointments') }}</span>
                    </a>
                 </li>
                 <li class="sidebar-item @if (request()->routeIs('admin.appointments.archived')) ? active @endif">
                    <a class="sidebar-link" href="{{ route('admin.appointments.archived') }}">
                        <i class="align-middle" data-feather="archive"></i>
                        <span class="align-middle">{{ __('Archived Appointments') }}</span>
                    </a>
                 </li>
                 <li class="sidebar-item @if (request()->routeIs('admin..program')) ? active @endif">
                    <a class="sidebar-link" href="{{ route('admin.program') }}">
                        <i class="align-middle" data-feather="calendar"></i>
                        <span class="align-middle">{{ __('Calandar') }}</span>
                    </a>
                 </li>
            </ul>
        </div>
    </nav>
</div>
