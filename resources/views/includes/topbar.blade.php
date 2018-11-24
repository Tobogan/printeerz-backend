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
                <div class="row align-items-center" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="col-auto">
                        <!-- Avatar -->
                        <a class="avatar avatar-sm">
                        <img src="/uploads/{{ Auth::user()->imageName }}" alt="..." class="avatar-img rounded-circle">
                        </a>
                    </div>
                    <div class="col ml--2">
                        <!-- Title -->
                        <h4 class="card-title mb-0">
                        <a  >{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</a>
                        </h4>
                        <!-- Time -->
                        <p class="card-text small">
                            {{ ucfirst(Auth::user()->role) }}
                        </p>
                    </div>
                    <div class="col-auto">
                    
                            <!-- Dropdown -->
                          
                              <a>
                                <i class="fe fe-chevron-down"></i>
                              </a>
         
                            
                          </div>
                </div>

                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right">
                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Déconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" >
                    {{ csrf_field() }}
                </form>
                </div>

            </div>

        </div>
    </div>
</nav>