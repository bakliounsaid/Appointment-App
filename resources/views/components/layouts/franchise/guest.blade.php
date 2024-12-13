<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css.map') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @livewireStyles

</head>

<body>
    <div class="wrapper">
        <div class="main">
            {{ $slot }}
        </div>
    </div>
    @livewireScripts
    <script src="assets/js/app.js"></script>
</body>

</html>
