<!doctype html>
<html lang="{{ app()->getLocale() }}" data-reactroot="">
<?php //session_start();
//$user_image = session('imageName');
?>

@include('includes.head')

<body style="display: block;">
    <div id="root">
        {{-- Sidebar --}}
        @include('includes.sidebar')
        {{-- Main Content --}}
        <div class="main-content">
            @include('includes.topbar')
            @yield('content')
        </div>
        
        {{-- Javascripts --}}
        @include('includes.js')
        @yield('javascripts')
    </div>
</body>
</html>