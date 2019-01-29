<div class="container" id="overview">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- #OVERVIEW -->
                @if($customer->events_id)
                <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="card-header-title">
                                    Evénements
                                </h4>
                            </div>
                            <div class="col-auto">
                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <!-- Toggle -->
                                    <a href="#" class="small text-muted dropdown-toggle" data-toggle="dropdown">
                                        Sort order
                                    </a>
                                    <!-- Menu -->
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item sort" data-sort="name" href="#!">
                                            Asc
                                        </a>
                                        <a class="dropdown-item sort" data-sort="name" href="#!">
                                            Desc
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <!-- Button -->
                                <a href="#!" class="btn btn-sm btn-primary">
                                    Ajouter un événement
                                </a>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <!-- Form -->
                                <form>
                                    <div class="input-group input-group-flush input-group-merge">
                                        <input type="search" class="form-control form-control-prepended search"
                                            placeholder="Rechercher un événement">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fe fe-search"></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-lg list-group-flush list my-n4">
                            @foreach($events as $event)
                                @foreach($customer->events_id as $event_id)
                                    @if($event->id == $event_id)
                                    <!-- List -->
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <a href="{{route('show_event', $event->id)}}" class="avatar avatar-lg">
                                                    @if($event->logoName)
                                                        <img src="{{ $event->logoName }}" alt="" class="avatar-img rounded">
                                                    @else
                                                        <?php 
                                                            $eventInitials = $event->name[0];
                                                        ?>
                                                        <span class="avatar-title rounded text-uppercase">{{ $eventInitials }}</span>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="col ml-n2">
                                                <!-- Title -->
                                                <h4 class="card-title mb-1 name">
                                                    <a href="{{route('show_event', $event->id)}}">{{ $event->name }}</a>
                                                </h4>
                                                <!-- Text -->
                                                <p class="card-text small text-muted mb-1">
                                                    @if($event->start_datetime)
                                                    <time datetime="{{ $event->start_datetime }}">{{ $event->start_datetime }}</time>
                                                    @else
                                                        <i>Pas de date renseignée</i>
                                                    @endif
                                                </p>
                                                <!-- Time -->
                                                <p class="card-text small text-muted">
                                                    @if($event->location['address'])
                                                        {{ $event->location['address'] }}
                                                    @else
                                                        <i>Pas d'adresse renseignée</i>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Button -->
                                                <a href="{{route('show_event', $event->id)}}" class="btn btn-sm btn-white d-none d-md-inline-block">
                                                    Voir
                                                </a>
                                            </div>
                                        </div> <!-- / .row -->
                                    </li>
                                
                                        @endif
                                    @endforeach
                             @endforeach
                        </ul>
                    </div>
                </div>
                @else
                <div class="card card-inactive">
                    <div class="card-body text-center">
                        <!-- Image -->
                        <img src="/img/svg/team_spirit.svg" alt="..." class="img-fluid" style="max-width: 182px;">
                        <!-- Title -->
                        <h1>
                            Pas d'événements programmés.
                        </h1>
                        <!-- Subtitle -->
                        <p class="text-muted">
                            Ajouter le premier événement
                        </p>
                        <!-- Button -->
                        <a href="#!" class="btn btn-primary">
                            Ajouter un événement
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>