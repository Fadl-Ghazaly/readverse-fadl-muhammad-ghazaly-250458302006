<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title ?? 'Admin Dashboard' }} | Readverse</title>

    <!-- Favicons -->
    <link href="{{ asset('niceadmin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('niceadmin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('niceadmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('niceadmin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('niceadmin/assets/css/style.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body>

    @include('livewire.admin.partials.header')
    @include('livewire.admin.partials.sidebar')

    <main id="main" class="main">
        {{ $slot }}
    </main>

    @include('livewire.admin.partials.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('niceadmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('niceadmin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('niceadmin/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('niceadmin/assets/js/main.js') }}"></script>

    @livewireScripts
</body>
</html>
