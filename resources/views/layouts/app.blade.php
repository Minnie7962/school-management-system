<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    @if(auth()->user()->role === 'admin')
        <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
    @elseif(auth()->user()->role === 'teacher')
        <link href="{{ asset('assets/css/teacher.css') }}" rel="stylesheet">
    @elseif(auth()->user()->role === 'student')
        <link href="{{ asset('assets/css/student.css') }}" rel="stylesheet">
    @elseif(auth()->user()->role === 'owner')
        <link href="{{ asset('assets/css/owner.css') }}" rel="stylesheet">
    @endif
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Page Content -->
        <div id="content">
            <!-- Navbar -->
            @include('layouts.partials.navbar')

            <!-- Main Content -->
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @if(auth()->user()->role === 'admin')
        <script src="{{ asset('assets/js/admin.js') }}"></script>
    @elseif(auth()->user()->role === 'teacher')
        <script src="{{ asset('assets/js/teacher.js') }}"></script>
    @elseif(auth()->user()->role === 'student')
        <script src="{{ asset('assets/js/student.js') }}"></script>
    @elseif(auth()->user()->role === 'owner')
        <script src="{{ asset('assets/js/owner.js') }}"></script>
    @endif
    @stack('scripts')
</body>
</html>
