<div>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{ route('admin.dashboard') }}" wire:navigate>
                <span class="align-middle">Admin</span>
            </a>

            <ul class="sidebar-nav @if (\App::currentLocale() == 'ar') fc-direction-rtl @endif">
                <li class="sidebar-item  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" wire:navigate>
                        <i class="align-middle" data-feather="sliders"></i>
                        <span class="align-middle">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="sidebar-item @if (request()->routeIs('admin.franchises.*')) ? active @endif">
                    <a class="sidebar-link" href="{{ route('admin.franchises.index') }}">
                        <i class="align-middle" data-feather="grid"></i>
                        <span class="align-middle">{{ __('Franchises') }}</span>
                    </a>
                 </li>
            </ul>
        </div>
    </nav>
</div>
