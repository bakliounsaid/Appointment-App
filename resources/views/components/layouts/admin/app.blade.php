<!DOCTYPE html>
<html lang="{{ \App::currentLocale() }}" @if (\App::currentLocale() == 'ar') dir="rtl" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    @livewireStyles

</head>

<body @if (\App::currentLocale() == 'ar') data-sidebar-position="right" class="fc-direction-rtl" @endif>
    <div class="wrapper">
        {{-- The guard should be 'admin' --}}
        @auth('admin')
            @livewire('admin.layout.sidebar')
            <div class="main">
                @livewire('admin.layout.header')
                {{ $slot }}
                @livewire('admin.layout.footer')
            </div>
        @else
            <div class="main">
                {{ $slot }}
            </div>
        @endauth
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}" data-spa="auto" defer></script>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    @livewireScripts

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('showAlert', (
                params
            ) => {
                Swal.fire({
                    title: params[0].title,
                    text: params[0].text,
                    icon: params[0].icon,
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    }
                });
                if (params.modal)
                    $(`#${params.modal}`).modal('hide')
            });
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
            Livewire.on('delete-confirmation', (
                params
            ) => {
                const title = params.title ?? "{{ __('Delete confirmation') }}";
                const text = params.text ?? "{{ __('Are you sure you want to delete this item') }}";

                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: "{{ __('Yes, delete it!') }}",
                    cancelButtonText: "{{ __('Cancel') }}",
                    buttonsStyling: false,
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-danger ms-1',
                        cancelButton: 'btn btn-outline-secondary',
                    }
                }).then(({
                    isConfirmed
                }) => {
                    if (isConfirmed) {
                        Livewire.dispatch(params.function, {
                            id: params.id
                        });

                    }
                });
            });
        });
    </script>
</body>

</html>
