<header class="header hp-header">
    <div class="header-container">
        <div class="">
            <a href="{{ route('client.home') }}" style="display: flex; align-items: center;">
                <img src="https://i.ibb.co/k2sZ8t6/logo-golden-wings.png" class="hp-logo" alt="GoTrip Logo">
            </a>
        </div>
        <nav class="nav d-none d-md-block">
            <ul style="gap: 2rem;">
                <li><a href="{{ route('client.home') }}">{{ __('Home') }}</a>
                </li>
                <li><a href="{{ route('client.programs.index') }}">{{ __('Programs') }}</a>
                </li>
                <li><a href="{{ route('client.about') }}">{{ __('About') }}</a>
                </li>
                <li><a href="{{ route('client.home') . '#contact' }}">{{ __('Contact') }}</a>
                </li>
            </ul>
        </nav>
        <div class="d-flex align-items-center gap-3">
            <div class="language-switcher">
                <!-- TODO : improve UI and functionality -->
                <button class="language-btn d-flex gap-2"
                    style="background-color: transparent; border: 1px solid rgba(212,175,55,0.3); color: #F5F5F5; padding: 0.5rem 1rem; border-radius: 6px;">
                    <span style="color: #D4AF37;">EN</span>
                </button>
            </div>
            <button class="hamburger-menu d-md-none" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
    <nav class="nav mobile-nav d-block w-100">
        <ul class="gap-5 flex-column px-3 py-4">
            <li><a class="d-block w-100" href="{{ route('client.home') }}">{{ __('Home') }}</a>
            </li>
            <li><a class="d-block w-100" href="{{ route('client.programs.index') }}">{{ __('Programs') }}</a>
            </li>
            <li><a class="d-block w-100" href="{{ route('client.about') }}">{{ __('About') }}</a>
            </li>
            <li><a class="d-block w-100" href="{{ route('client.home') . '#contact' }}">{{ __('Contact') }}</a>
            </li>
        </ul>
    </nav>
</header>
<script>
const hamburgerMenu = document.querySelector('.hamburger-menu');
const mobileNav = document.querySelector('.mobile-nav');

hamburgerMenu.addEventListener('click', function() {
    this.classList.toggle('active');
    mobileNav.classList.toggle('active');
});
</script>
