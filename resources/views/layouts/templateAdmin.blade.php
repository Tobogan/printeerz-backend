<!doctype html>
<html lang="{{ app()->getLocale() }}" data-reactroot="">
<?php //session_start();
//$user_image = session('imageName');
?>

@include('includes.head')

<body style="display: block;">
    <div id="root">
        {{-- Sidebar --}}
        {{-- @include('includes.sidebar') --}}
        {{-- Main Content --}}
        <div class="main-content">
            @include('includes.topbar')
            @yield('content')
        </div>
        
        {{-- Javascripts --}}
        @include('includes.js')
        @yield('javascripts')
    </div>

</script>
    {{-- <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('js/form.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/js.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/App.js') }}"></script> --}}

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@yield('javascripts')
</body>
</html>