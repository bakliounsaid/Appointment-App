<div>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{ route('agency.dashboard') }}" wire:navigate>
                <span class="align-middle">Agency</span>
            </a>

            <ul class="sidebar-nav @if (\App::currentLocale() == 'ar') fc-direction-rtl @endif">
                <li class="sidebar-item @if (request()->routeIs('agency.dashboard')) active @endif">
                    <a class="sidebar-link" href="{{ route('agency.dashboard') }}" wire:navigate>
                        <i class="align-middle" data-feather="sliders"></i>
                        <span class="align-middle">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="sidebar-item @if (request()->routeIs('agency.bookings.*')) active @endif">
                    <a class="sidebar-link" href="{{ route('agency.bookings.index') }}" wire:navigate>
                        <i class="align-middle" data-feather="book-open"></i>
                        <span class="align-middle">{{ __('Bookings') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
