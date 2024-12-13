<div>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{ route('franchise.dashboard') }}" wire:navigate>
                <span class="align-middle">Franchise</span>
            </a>

            <ul class="sidebar-nav @if (\App::currentLocale() == 'ar') fc-direction-rtl @endif">
                <li class="sidebar-item {{ Route::currentRouteName() == 'franchise.dashboard' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('franchise.dashboard') }}" wire:navigate>
                        <i class="align-middle" data-feather="sliders"></i>
                        <span class="align-middle">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="sidebar-item @if (request()->routeIs('franchise.hotels.*')) ? active @endif ">
                    <a class="sidebar-link" href="{{ route('franchise.hotels.index') }}">
                        <i class="align-middle" data-feather="grid"></i>
                        <span class="align-middle">{{ __('Hotels') }}</span>
                    </a>
                </li>
                <li class="sidebar-item @if (request()->routeIs('franchise.agencies.*')) ? active @endif ">
                    <a class="sidebar-link" href="{{ route('franchise.agencies.index') }}">
                        <i class="align-middle" data-feather="home"></i>
                        <span class="align-middle">{{ __('Agencies') }}</span>
                    </a>
                </li>
                <li class="sidebar-item @if (request()->routeIs('franchise.programs.*')) ? active @endif ">
                    <a class="sidebar-link" href="{{ route('franchise.programs.index') }}">
                        <i class="align-middle" data-feather="briefcase"></i>
                        <span class="align-middle">{{ __('Programs') }}</span>
                    </a>
                </li>
                <li class="sidebar-item @if (request()->routeIs('franchise.flights.*')) ? active @endif ">
                    <a class="sidebar-link" href="{{ route('franchise.flights.index') }}">
                        <i class="align-middle" data-feather="navigation"></i>
                        <span class="align-middle">{{ __('Flights') }}</span>
                    </a>
                </li>
                <li class="sidebar-item @if (request()->routeIs('franchise.companies.*')) ? active @endif ">
                    <a class="sidebar-link" href="{{ route('franchise.companies.index') }}">
                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">{{ __('Companies') }}</span>
                    </a>
                </li>
                <li class="sidebar-item @if (request()->routeIs('franchise.airports.*')) ? active @endif ">
                    <a class="sidebar-link" href="{{ route('franchise.airports.index') }}">
                        <i class="align-middle" data-feather="map-pin"></i>
                        <span class="align-middle">{{ __('Airports') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
