<nav class="navbar navbar-expand-md navbar-light d-none d-md-flex" id="topbar">
    <div class="container-fluid">

        <!-- Form -->
        <form class="form-inline mr-4 d-none d-md-flex">
        </form>

        <!-- User -->
        <div class="navbar-user">

            <!-- Dropdown -->
            <div class="dropdown">

                <!-- Toggle -->
                <a href="#" class="avatar avatar-sm avatar-online dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/uploads/{{ Auth::user()->imageName }}" alt="..." class="avatar-img rounded-circle">
                </a>

                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</a>
                <hr class="dropdown-divider">
                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Déconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" >
                    {{ csrf_field() }}
                </form>
                </div>

            </div>

        </div>
    </div>
</nav>