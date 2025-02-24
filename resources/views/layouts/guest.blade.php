{{-- Vista utilizada para cargar las vistas de login/registro --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tejidos Violeta') }}</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- FONTAWESOME ICONS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- VITE (Hojas CSS y JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100 custom-guest">
    <div class="flex-grow-1 d-flex align-items-center justify-content-center">
        <main>
            <div class=" d-flex justify-content-center pb-5">
                <img src="https://pbs.twimg.com/profile_images/947504948765450240/nZtFY4Lb_400x400.jpg"
                    class="rounded-circle custom-guest-logo">
            </div>
            <div class="border border-3 rounded p-5 pt-4 mb-5 bg-white">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
