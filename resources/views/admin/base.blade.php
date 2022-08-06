<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title') @hasSection('subtitle') - @yield('subtitle') @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link href="{{ asset('assets/admin/styles/main.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('admin.includes.header')
        @include('admin.includes.settings')
        <div class="app-main">
                @include('admin.includes.sidebar')
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        @include('admin.includes.page-title')
                        @yield('content')
                    </div>
                    @include('admin.includes.footer')
                </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    @stack('modals')
    @include('admin.includes.notification')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/scripts/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/scripts/sortable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/scripts/bootstrap.js') }}"></script>
    @stack('scripts')
</body>
</html>
