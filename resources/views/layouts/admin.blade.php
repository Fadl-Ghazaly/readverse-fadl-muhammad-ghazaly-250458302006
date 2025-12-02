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
    <link href="{{ asset('NiceAdmin/assets/css/style.css') }}" rel="stylesheet">

  

    @livewireStyles
</head>

<body>

    <div id="layout-wrapper">

        @include('livewire.admin.partials.header')
        @include('livewire.admin.partials.sidebar')

        <main id="main" class="main">
            {{ $slot }}
        </main>

        @include('livewire.admin.partials.footer')

    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>

    <script src="{{ asset('NiceAdmin/assets/vendor/tinymce/tinymce.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('NiceAdmin/assets/js/main.js') }}"></script>

    @livewireScripts
</body>

</html>
