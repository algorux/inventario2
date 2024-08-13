<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Inventario') }}</title>
        <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
        
        <script src="/assets/plugins/jquery/jquery.min.js"></script>
        <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="layout-top-nav" style="height: auto;">
        <div class="wrapper">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    
                        {{ $header }}
                    
                </header>
            @endif

            <!-- Page Content -->
            <section class="content">
                <div class="container-fluid">
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </section>
        </div>
    </body>
</html>
