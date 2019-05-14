<div id="overview">
    <div class="row justify-content-center">
        <div class="col-12">
            @if($customer->events_id)
            <div class="card" data-toggle="lists" data-lists-values="">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-header-title">
                                Evénements
                            </h4>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('clientCreate_event', $customer->id)}}" class="btn btn-sm btn-primary">
                                Ajouter un événement
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <!-- Form -->
                            <form>
                                <div class="input-group input-group-flush input-group-merge">
                                    <input type="search" class="form-control form-control-prepended search" placeholder="Rechercher un événement">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fe fe-search"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-lg list-group-flush list my-n4">
                        @foreach($events as $event)
                        @foreach($customer->events_id as $event_id)
                        @if($event->id == $event_id)
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <a href="{{route('show_event', $event->id)}}" class="avatar avatar-lg">
                                        @if(file_exists(public_path('uploads/'.$event->logoName)) &&
                                        !empty($event->logoName))
                                        <img src="{{ $event->logoName }}" alt="" class="avatar-img rounded">
                                        @else
                                        <?php $eventInitials = $event->name[0]; ?>
                                        <span class="avatar-title rounded text-uppercase">{{ $eventInitials }}</span>
                                        @endif
                                    </a>
                                </div>
                                <div class="col ml-n2">
                                    <h4 class="card-title mb-1 name">
                                        <a href="{{route('show_event', $event->id)}}">{{ $event->name }}</a>
                                    </h4>
                                    <p class="card-text small text-muted mb-1">
                                        @if($event->start_datetime)
                                        <time datetime="{{ $event->start_datetime }}">{{ $event->start_datetime }}</time>
                                        @else
                                        <i>Pas de date renseignée</i>
                                        @endif
                                    </p>
                                    <p class="card-text small text-muted">
                                        @if($event->location['address'])
                                        {{ $event->location['address'] }}
                                        @else
                                        <i>Pas d'adresse renseignée</i>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('show_event', $event->id)}}" class="btn btn-sm btn-white d-none d-md-inline-block">
                                        Voir
                                    </a>
                                </div>
                            </div>
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
                    <img src="/img/svg/team_spirit.svg" alt="no-customer-events" class="img-fluid" style="max-width: 182px;">
                    <h1>
                        Pas d'événements programmés.
                    </h1>
                    <p class="text-muted">
                        Ajouter le premier événement
                    </p>
                    <a href="{{route('clientCreate_event', $customer->id)}}" class="btn btn-primary">
                        Ajouter un événement
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>