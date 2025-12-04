<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'User Panel' }} - Readverse</title>

    <link href="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" rel="icon">

    <!-- Vendor CSS -->
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Tailwind & Alpine -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-slate-50 font-sans text-slate-900" x-data="{ sidebarOpen: false }">

    <div id="layout-wrapper">

        @include('livewire.user.partials.header')
        @include('livewire.user.partials.sidebar')

        <main class="pt-16 lg:pl-64 min-h-screen transition-all duration-300">
            {{ $slot }}
        </main>

        <div class="lg:pl-64">
            @include('livewire.user.partials.footer')
        </div>

    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/echarts/echarts.min.js') }}" defer></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/quill/quill.min.js') }}" defer></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') }}" defer></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/tinymce/tinymce.min.js') }}" defer></script>

    @livewireScripts
</body>

</html>