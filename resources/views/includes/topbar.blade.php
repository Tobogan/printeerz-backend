<nav class="navbar navbar-expand-md navbar-dark d-none d-md-flex" id="topbar">
    <div class="container-fluid">

        <a class="navbar-brand mr-auto" href="{{route('home')}}">
            <img src="{{ asset('img/logo/logo.png')}}" class="navbar-brand-img  mx-auto" alt="...">
        </a>
        <!-- User -->
        <div class="navbar-user">

            <!-- Dropdown -->
            <div class="dropdown">

                <!-- Toggle -->
                <div class="row align-items-center" class="dropdown-toggle" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="col-auto">
                        <!-- Avatar -->
                        <a class="avatar avatar-sm">
                            <img src="/uploads/{{ Auth::user()->imageName }}" alt="..." class="avatar-img rounded-circle">
                        </a>
                    </div>
                    <div class="col ml--2">
                        <!-- Title -->
                        <h4 class="card-title mb-0">
                            <a class="text-white">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</a>
                        </h4>
                        <!-- Time -->
                        <p class="card-text small text-light">
                            {{ ucfirst(Auth::user()->role) }}
                        </p>
                    </div>
                    <div class="col-auto">

                        <!-- Dropdown -->

                        <a class="text-light">
                            <i class="fe fe-chevron-down"></i>
                        </a>


                    </div>
                </div>

                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item">Déconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>

            </div>

        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-md navbar-light d-none d-md-flex" id="topbar">
    <div class="container-fluid">

        <!-- Nav -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item px-2">
                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{route('home')}}">
                    <i class="fe fe-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link {{ request()->is('admin/Event/*') ? 'active' : '' }}" href="{{route('index_event')}}">
                    <i class="fe fe-calendar"></i> Evénements
                </a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link {{ request()->is('admin/Customer/*') ? 'active' : '' }}" href="{{route('index_customer')}}">
                    <i class="fe fe-inbox"></i> Clients
                </a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link {{ request()->is('admin/Product/*') ? 'active' : '' }}" href="{{route('index_product')}}">
                    <i class="fe fe-layers"></i> Produits
                </a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link {{ request()->is('admin/User/*') ? 'active' : '' }}" href="{{route('user_index')}}">
                    <i class="fe fe-user"></i> Utilisateurs
                </a>
            </li>
        </ul>

    </div>
</nav>