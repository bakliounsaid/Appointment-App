<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if (app()->getLocale() === 'ar') dir="rtl" @endif>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Votre entreprise de décoration et installation de rideaux, et réseaux.">
    <meta name="keywords" content="rideaux, décoration intérieure, installation, réseaux">
    <meta name="author" content="Chaima Rideaux">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>Chaima Rideaux</title>

    <!-- Preconnect & Preload -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" />

    @hasSection('meta')
        @yield('meta')
    @else
        <!-- Open Graph par défaut -->
        <meta property="og:title" content="Chaima Rideaux - Décoration de Fenêtres" />
        <meta property="og:description"
            content="Votre entreprise de décoration et installation de rideaux, et réseaux." />
        <meta property="og:image" content="{{ asset('assets/img/photos/logo.jpg') }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="website" />

        <!-- Twitter -->
        <meta name="twitter:title" content="Chaima Rideaux - Décoration de Fenêtres" />
        <meta name="twitter:description"content="Votre entreprise de décoration et installation de rideaux, et réseaux." />
        <meta name="twitter:image" content="{{ asset('assets/img/photos/logo.jpg') }}" />
        <meta name="twitter:card" content="summary_large_image" />
    @endif

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/photos/logo.jpg') }}" type="image/jpeg" />

    <!-- Fonts (async load) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"
        media="print" onload="this.media='all';">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    </noscript>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/styles.css') }}">

    @livewireStyles

    <!-- Defer Bootstrap -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</head>

<body>
    @livewire('client.layout.header')

    {{ $slot }}

    @livewire('client.layout.footer')

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    @livewireScripts

    <!-- Inline script (deferred tasks) -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-toast-alert', (params) => {
                Swal.fire({
                    toast: true,
                    text: params[0].text,
                    icon: params[0].icon,
                    position: params[0].position ?? "top-end",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                });
                if (params.modal) document.getElementById(params.modal)?.classList.remove(
                    'show'); // use vanilla JS
            });
        });

        const header = document.querySelector('.hp-header');
        window.addEventListener('scroll', () => {
            header?.classList.toggle("scrolled", window.scrollY > 10);
        });

        document.querySelector('form')?.addEventListener('submit', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>
