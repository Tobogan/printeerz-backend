<!doctype html>
<html lang="{{ app()->getLocale() }}" data-reactroot="">
@include('includes.head')

<body>
    <div id="root">
        <div class="alerts">
            @if (session('status'))
                <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" id="Alert" role="alert" data-dismiss="alert" >
                    {{ session('status') }}
                </div>
            @endif    
        </div>
        <div class="main-content">
            @include('includes.topbar')
            @yield('content')
        </div>
        {{-- Javascripts --}}
        @include('includes.js')
        @yield('javascripts')
        @if (session('status'))
            <script>
                $('#Alert').alert();
                var closeAlert = function(){
                    $('#Alert').alert('close')
                };
                setTimeout(closeAlert, 5000);
            </script>
        @endif
    </div>
</body>
</html>