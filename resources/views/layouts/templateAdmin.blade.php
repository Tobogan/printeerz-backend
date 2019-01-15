<html lang="fr" data-reactroot="">
<?php //session_start();

//$user_image = session('imageName');
?>
<head>
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charSet="utf-8" />
    <title>Printeerz Dashboard</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="/css/styles.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatable.css') }}"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">   
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/App.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatable.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/App.scss') }}"/>
    
</head>
<body>
    <link async="" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet" />
    <div id="root">
        <div class="uik-PageFade__animationWrapper uik-App__app" style="position:relative">
            <div class="uik-container-h__wrapper">
                <div class="uik-nav-panel__wrapper">
                    <div class="uik-container-v__container">
                        <div class="uik-top-bar__wrapper uik-top-bar__center">
                            <div  class="uik-top-bar-section__wrapper" href="{{route('home')}}"><i class="uikon">home</i></div>
                        </div>
                        <div class="uik-scroll__wrapper">
                            <div class="uik-nav-user__wrapper">
                                
                            <!-- ~~~~~~~~________ PHOTO DE PROFIL DU USER ________~~~~~~~~ -->
                                @if(Auth::check())
                            @if( Auth::user()->profile_img)
                                <div class="uik-nav-user__avatarWrapper"><img alt="bob" class="uik-nav-user__avatar" src="/uploads/{{ Auth::user()->profile_img }}" /></div><span class="uik-nav-user__name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>

                                @if(Auth::user()->role == 2)
                                    <span class="uik-nav-user__textTop">Administrateur</span></div>
                                @elseif(Auth::user()->role == 1)
                                    <span class="uik-nav-user__textTop">Opérateur</span></div>
                                @elseif(Auth::user()->role == 3)
                                    <span class="uik-nav-user__textTop">Technicien</span></div>
                                @endif
                            @else     
                                <div class="uik-nav-user__avatarWrapper"><img alt="bob" class="uik-nav-user__avatar" src="/uploads/no_image.jpg" /></div><span class="uik-nav-user__name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                                         
                            <!-- ~~~~~~~~________ ROLE DU USER ________~~~~~~~~ -->
                                    @if(Auth::user()->role == 2)
                                                                <span class="uik-nav-user__textTop">Administrateur</span></div>
                                    @elseif(Auth::user()->role == 1)
                                                                <span class="uik-nav-user__textTop">Opérateur</span></div>
                                    @elseif(Auth::user()->role == 3)
                                                                <span class="uik-nav-user__textTop">Technicien</span></div>
                                    @endif
                                    
                                @endif
                            @else
                                <?php return redirect('errors/404');?>
                            @endif
                <div class="uik-divider__horizontal"></div>

                <!-- ~~~~~~~~________ NAV DE GAUCHE ________~~~~~~~~ -->
                <div class="uik-nav-link-two-container__wrapper">
                <a class="uik-nav-link-2__wrapper active uik-nav-link-2__highlighted" href="{{route('home')}}">
                    <span class="uik-nav-link-2__text">
                        <span class="uik-nav-link-2__icon" ><i class="uikon">stats</i></span>Dashboard</span>
                </a>
                <a class="uik-nav-link-2__wrapper uik-nav-link-2__highlighted" href="{{route('user_index')}}">
                    <span class="uik-nav-link-2__text">
                    <span class="uik-nav-link-2__icon" ><i class="uikon">profile_round</i></span>Utilisateurs</span>
                    </a>
                <a class="uik-nav-link-2__wrapper uik-nav-link-2__highlighted" href="{{route('index_event')}}">
                    <span class="uik-nav-link-2__text"><span class="uik-nav-link-2__icon"><i class="uikon">calendar</i>
                    </span>Evénements</span></a>
                    <a class="uik-nav-link-2__wrapper uik-nav-link-2__highlighted" href="{{route('index_customer')}}"><span class="uik-nav-link-2__text"><span class="uik-nav-link-2__icon"><i class="uikon">profile_plus_round</i></span>Clients</span></a>
                    <a class="uik-nav-link-2__wrapper uik-nav-link-2__highlighted"  href="{{route('index_product')}}"><span class="uik-nav-link-2__text"><span class="uik-nav-link-2__icon"><i class="uikon">money_round</i></span>Produits</span></a>
                    {{-- <a class="uik-nav-link-2__wrapper uik-nav-link-2__highlighted"  href="{{route('index_product')}}"><span class="uik-nav-link-2__text"><span class="uik-nav-link-2__icon"><i class="uikon">gallery_grid_view</i></span>Gabarits</span></a> --}}

                    <a href="{{route('logout')}}" onclick="event.preventDefault(); confirm('Êtes-vous sûr de vouloir vous déconnecter ?'); document.getElementById('logout-form').submit();" class="uik-nav-link-2__wrapper active uik-nav-link-2__highlighted" ><span class="uik-nav-link-2__text "><span class="uik-nav-link-2__icon"><i class="uikon">trending_down</i></span>Déconnexion</span></a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" >
                                {{ csrf_field() }}
                            </form></div>
                <!-- <section class="uik-nav-section__wrapper"><span class="uik-nav-section-title__wrapper">Recently viewed</span><a class="uik-nav-link__wrapper"><span class="uik-nav-link__text">Overall Performance</span><span class="uik-nav-link__rightEl">→</span></a><a class="uik-nav-link__wrapper"><span class="uik-nav-link__text">Invoice #845</span><span class="uik-nav-link__rightEl">→</span></a><a class="uik-nav-link__wrapper"><span class="uik-nav-link__text">Customer: Minerva Viewer</span><span class="uik-nav-link__rightEl">→</span></a></section> -->
            </div>
        </div>
    </div>
                
                <div class="uik-container-v__container">
                    <div class="uik-top-bar__wrapper">
                        <div class="uik-top-bar-section__wrapper">
                        <?php 
                        $mystring = $_SERVER['REQUEST_URI'];
                        $create = 'create';
                        $edit = 'edit';
                        $show = 'show';
                        $home = 'home';
                        $store = 'store';
                        $destroy = 'destroy';
                        $pos = strpos($mystring, $create);
                        $pos1 = strpos($mystring, $edit);
                        $pos2 = strpos($mystring, $show);
                        $pos3 = strpos($mystring, $home);
                        $pos4 = strpos($mystring, $store);
                        $pos5 = strpos($mystring, $destroy);
                        ?>
                        
                        @if($pos == true)
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Ajout</h2></div>
                        @elseif($pos1 == true)
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Modification</h2></div>
                        @elseif($pos2 == true)
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Détails</h2></div>
                        @elseif($pos3 == true)
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Dashboard</h2></div>
                        @elseif($pos4 == true)
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Ajout</h2></div>
                        @elseif($pos5 == true)
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Détail</h2></div>
                        @endif


                        @if($_SERVER['REQUEST_URI'] == '/admin/Product/index')
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Gestion des produits</h2></div>

                        @elseif($_SERVER['REQUEST_URI'] == '/admin/Event/index')
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Gestion des événements</h2></div>

                        @elseif($_SERVER['REQUEST_URI'] == '/admin/Customer/index')
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Gestion des clients</h2></div>

                        @elseif($_SERVER['REQUEST_URI'] == '/admin/User/index')
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Gestion des utilisateurs</h2></div>
                        
                        @elseif($_SERVER['REQUEST_URI'] == '/admin/Couleur/index')
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Gestion des tailles & couleurs</h2></div>
                        @elseif($_SERVER['REQUEST_URI'] == '/')
                            <h2 class="uik-top-bar-title__wrapper uik-top-bar-title__large">Home</h2></div>
                        @endif

                        <!-- ~~~~~~~~________ TITRE POUR CHAQUE PAGE EN FONCTION DE L'URI ________~~~~~~~~ -->

                        <div class="uik-top-bar-section__wrapper">
                            <div class="uik-select__wrapper">
                                <!-- ~~~~~~~~________ BOUTON CHOIX DE LANGUE ________~~~~~~~~ -->
                                <!--<button class="uik-btn__base uik-select__valueRendered" type="button">
                                    <div class="uik-btn__content">
                                        <div class="uik-select__valueRenderedWrapper">
                                            <div class="uik-select__valueWrapper"><span><img alt="english" class="uik-analytics-header__selectFlag" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAKCAYAAACE2W/HAAAAAXNSR0IArs4c6QAAAfFJREFUKBVVkD9oE3EUgL/fXf41TWhS1MZa29pGBxEqrTqIo6BGW0Fs6CAO6qA4VKzo0hTUOii4SMHNoSjBgtDBRqNiEB0silbwD1WTiKZgorU5TWIuyd15OVz64D14j+/jPZ74cnZ0puPccCg6qzA++Y7k1zzKk8OkVvjQFIVN5TIrB6ZpbrRxaneAQ9IHqoG2mDRu3xGKHY+wz53h6cUeTh5cT0WtooKVmimGt3hIDK+hP/OAdN9Oxj76Q6Lv2D0jGFzF+dY0AZdG02AYw5Te+P1o+Ty9qoqYf4syn+RP/yBj117w/vMiovT4keGSdEqahG4augnWIxUOoxeLdE1NIft8CFlGVFTcLhuSLBCzYGgWurw4/reV5WOrk8wqFk8cNWo6lNUaht3EdR29VOJXNIpwOGgeGrJg4XRSF+rX6c4GxEDkmbGhw8/IkY14HsbxdHdidAZ5ZbNZJ25eWrLEQvw+OVXmaq6ddOoHUgMau7pt1C5foSgcjN78hF4oWDCGQaFU5dKN12it7fjtGtvuTuAqKYjUdNwI/M5wR2nh+ssKye9/Wbi9lznzIXJTE+syOdr23GJrz2rOHOgitLbG3MQktpaFVCzq7g1dSGTJ/SxjlyVkr5dGc6csBF6Pg0JZIvE8y7dsherp7eyPjMz8AyZFwToTjm94AAAAAElFTkSuQmCC"/>ENG</span></div>
                                            <div class="uik-select__arrowWrapper"></div>
                                        </div>
                                    </div>
                                </button>-->
                            </div>
                        </div>
                    </div>
                    @yield('content')
                         
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    {{-- <script
    src="{{ asset('js/ajax.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/datatable.js') }}"></script> --}}
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>$(document).ready(function() {
        if($(".datatable")[0]){
            $('.datatable').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
      }
    });
        }
} );

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