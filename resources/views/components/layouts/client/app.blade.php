<!DOCTYPE html>
<html lang="{{ \App::currentLocale() }}" @if (\App::currentLocale() == 'ar') dir="rtl" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Votre entreprise de décoration et installation de rideaux, et réseaux.">
    <meta name="keywords" content="rideaux, décoration intérieure, installation, réseaux">
    <meta name="author" content="Chaima Rideaux">
    <title>Chaima Rideaux</title>

    <!-- Open Graph (pour les réseaux sociaux) -->
    <meta property="og:title" content="Page d'accueil - Décoration de Fenêtres">
    <meta property="og:description" content="Découvrez notre gamme de produits pour fenêtres, rideaux, et décoration.">
    <meta property="og:image" content="{{ asset('assets/img/photos/logo.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Twitter Card (pour Twitter) -->
    <meta name="twitter:title" content="Page d'accueil - Décoration de Fenêtres">
    <meta name="twitter:description" content="Découvrez notre gamme de produits pour fenêtres, rideaux, et décoration.">
    <meta name="twitter:image" content="{{ asset('assets/img/photos/logo.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/photos/logo.jpg') }}" />

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/client/css/styles.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @livewireStyles
</head>

<body>
    @livewire('client.layout.header')
    {{ $slot }}
    @livewire('client.layout.footer')

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    @livewireScripts

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
                if (params.modal)
                    $(`#${params.modal}`).modal('hide')
            });
        });
    </script>
</body>

<script>
    const header = document.querySelector('.hp-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });
    document.querySelector('form').addEventListener('submit', () => {
        window.scrollTo(0, 0);
    });
</script>

</html>
