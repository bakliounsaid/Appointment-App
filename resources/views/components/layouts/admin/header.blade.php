<div>
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align @if (\App::currentLocale() == 'ar') fc-direction-rtl @endif">
                <li class="nav-item dropdown ">
                    <a class="nav-flag dropdown-toggle" href="#" id="languageDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset('assets/img/flags/' . \App::currentLocale() . '.png') }}"
                            alt="{{ \App::currentLocale() }}">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end @if (\App::currentLocale() == 'ar') fc-direction-rtl @endif"
                        aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="#" wire:click.prevent="setLocale('en')">
                            <img src="{{ asset('assets/img/flags/en.png') }}" alt="English" width="20"
                                class="align-middle me-1">
                            <span class="align-middle">English</span>
                        </a>
                        <a class="dropdown-item" href="#" wire:click.prevent="setLocale('ar')">
                            <img src="{{ asset('assets/img/flags/ar.png') }}" alt="العربية" width="20"
                                class="align-middle me-1">
                            <span class="align-middle">العربية</span>
                        </a>
                        <a class="dropdown-item" href="#" wire:click.prevent="setLocale('fr')">
                            <img src="{{ asset('assets/img/flags/fr.png') }}" alt="Français" width="20"
                                class="align-middle me-1">
                            <span class="align-middle">Français</span>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown fc-direction-ltr">
                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                        data-bs-toggle="dropdown">
                        <i class="align-middle" data-feather="settings"></i>
                    </a>
                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1"
                            alt="{{ $admin->name }}" />
                        <span class="text-dark">{{ $admin->name }}</span>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-end @if (\App::currentLocale() == 'ar') fc-direction-rtl @endif">
                        <a class="dropdown-item" href="#">
                            <i class="align-middle me-1" data-feather="user"></i> {{ __('Profile') }}
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy
                        </a>
                        <a class="dropdown-item" href="#" wire:click.prevent="logout">
                            <i class="align-middle me-1" data-feather="log-out"></i> {{ __('Log out') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
