<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    @include('backend.layouts.styles')
</head>
<body id="page-top">
<div id="wrapper">
    @include('backend.layouts.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('flash::message')
            @include('backend.layouts.header')
            @yield('content')
        </div>
        @include('backend.layouts.footer')
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
@include('backend.layouts.logout')
@include('backend.layouts.scripts')
</body>
</html>
