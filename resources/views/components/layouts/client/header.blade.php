<header class="header hp-header">
    <div class="header-container">
        <div>
            <a href="{{ route('client.home') }}" style="display: flex; align-items: center;">
                <img src="{{ asset('assets/img/photos/logo.png') }}" class="hp-logo" alt="Logo">
            </a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="nav d-none d-md-block">
            <ul style="gap: 2rem;">
                <li><a href="{{ route('client.home') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('client.product.index') }}">{{ __('Our Products') }}</a></li>
            </ul>
        </nav>

        <!-- Language Switch & Hamburger -->
        <div class="d-flex align-items-center gap-3">
            <button wire:click="toggleLanguage" class="language-btn d-flex gap-2"
                style="background-color: transparent; border: 1px solid rgba(212,175,55,0.3); color: #F5F5F5; padding: 0.5rem 1rem; border-radius: 6px;">
                <span style="color: #D4AF37;">
                    {{ strtoupper($language === 'fr' ? 'العربية' : 'FranÇais') }}
                </span>
            </button>

            <button class="hamburger-menu d-md-none" aria-label="Toggle navigation" aria-expanded="false" aria-controls="mobile-nav">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <nav class="nav mobile-nav d-block w-100" id="mobile-nav">
        <ul class="gap-5 flex-column px-3 py-4">
            <li><a class="d-block w-100" href="{{ route('client.home') }}">{{ __('Home') }}</a></li>
            <li><a class="d-block w-100" href="{{ route('client.product.index') }}">{{ __('Our Products') }}</a></li>
        </ul>
    </nav>
</header>

<!-- JavaScript to Toggle Mobile Menu -->
<script>
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const mobileNav = document.querySelector('.mobile-nav');

    hamburgerMenu.addEventListener('click', function () {
        this.classList.toggle('active');
        mobileNav.classList.toggle('active');

        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
    });
</script>
