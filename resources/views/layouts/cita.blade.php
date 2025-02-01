<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Posta Médica">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | @yield('title') </title>
    @section('stylesheets')
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    @show
    <style>
        body {
            background-image: url('{{ asset('images/background/background-login.jpeg') }}');
            background-size: cover; /* Cambiado a 'cover' para que la imagen ocupe toda la pantalla */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* Mantiene la imagen fija al hacer scroll */
        }
        /* Pseudo-elemento para la superposición */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(36, 36, 36, 0.3); /* Cambia el color y la opacidad aquí */
            z-index: 1; /* Asegúrate de que esté por encima de la imagen de fondo */
        }
        .d-flex {
            height: 100vh; /* Asegúrate de que el contenedor ocupe toda la altura de la ventana */
            position: relative; /* Necesario para que el contenido esté por encima de la superposición */
            z-index: 2; /* Asegúrate de que el contenido esté por encima de la superposición */
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
