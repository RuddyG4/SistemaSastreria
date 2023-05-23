<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>titulo</title>
    <link rel="shortcut icon" href="{{ asset('images/logo-icon.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css')}}">
    @livewireStyles
</head>
<body>
    {{ $slot }}

    @livewireScripts
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
</body>
</html>