<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - Readverse</title>

      <link href="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" rel="icon">


    <!-- Vendor CSS -->
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    {{-- <link href="{{ asset('NiceAdmin/assets/css/style.css') }}" rel="stylesheet"> --}}

    <!-- Tailwind & Alpine -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-slate-50 font-sans text-slate-900" x-data="{ sidebarOpen: false }">

    <div id="layout-wrapper">

        @include('livewire.admin.partials.header')
        @include('livewire.admin.partials.sidebar')

        <main class="pt-16 lg:pl-64 min-h-screen transition-all duration-300">
            {{ $slot }}
        </main>

        <div class="lg:pl-64">
            @include('livewire.admin.partials.footer')
        </div>

    </div>

    <!-- Vendor JS - Only load what's actually used, with defer for better performance -->
    <script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>

    @livewireScripts
</body>

</html>
