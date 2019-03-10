<!doctype html>
<html lang="{{ app()->getLocale() }}" data-reactroot="">
@include('includes.head')

<body>
    <div id="root">
        <div class="alerts">
            @yield('alerts')
        </div>
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