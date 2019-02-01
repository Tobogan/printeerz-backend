<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse"
            aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{ asset('img/logo/logo.png')}}" class="navbar-brand-img 
                  mx-auto" alt="...">
        </a>

        <!-- User (xs) -->
        <div class="navbar-user d-md-none">

            <!-- Dropdown -->
            <div class="dropdown">

                <!-- Toggle -->
                <a href="#" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <img src="/uploads/{{ Auth::user()->imageName }}" class="avatar-img rounded-circle" alt="...">
                    </div>
                </a>

                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarIcon">
                    <a href="profile-posts.html" class="dropdown-item">Profile</a>
                    <a href="settings.html" class="dropdown-item">Settings</a>
                    <hr class="dropdown-divider">
                    <a href="sign-in.html" class="dropdown-item">Logout</a>
                </div>

            </div>

        </div>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">

            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fe fe-search"></span>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{route('home')}}">
                        <i class="fe fe-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/Event/*') ? 'active' : '' }}" href="{{route('index_event')}}">
                        <i class="fe fe-calendar"></i> Evénements
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/Customer/*') ? 'active' : '' }}" href="{{route('index_customer')}}">
                        <i class="fe fe-inbox"></i> Clients
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/Product/*') ? 'active' : '' }}" href="{{route('index_product')}}">
                        <i class="fe fe-layers"></i> Produits
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/User/*') ? 'active' : '' }}" href="{{route('user_index')}}">
                        <i class="fe fe-user"></i> Utilisateurs
                    </a>
                </li>
            </ul>

            <!-- Push content down -->
            <div class="mt-auto"></div>

            <!-- User (md) -->
            <div class="navbar-user d-none d-md-flex" id="sidebarUser" style="display: none !important">

                <!-- Icon -->
                <a href="#sidebarModalActivity" class="navbar-user-link" data-toggle="modal">
                    <span class="icon">
                        <i class="fe fe-bell"></i>
                    </span>
                </a>

                <!-- Dropup -->
                <div class="dropup">

                    <!-- Toggle -->
                    <a href="#" id="sidebarIconCopy" class="dropdown-toggle" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                            <img src="/uploads/{{ Auth::user()->imageName }}" class="avatar-img rounded-circle" alt="...">
                        </div>
                    </a>

                    <!-- Menu -->
                    <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">
                        <a href="profile-posts.html" class="dropdown-item">Profile</a>
                        <a href="settings.html" class="dropdown-item">Settings</a>
                        <hr class="dropdown-divider">
                        <a href="sign-in.html" class="dropdown-item">Logout</a>
                    </div>

                </div>

                <!-- Icon -->
                <a href="#sidebarModalSearch" class="navbar-user-link" data-toggle="modal">
                    <span class="icon">
                        <i class="fe fe-search"></i>
                    </span>
                </a>

            </div>

        </div> <!-- / .navbar-collapse -->

    </div>
</nav>