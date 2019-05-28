@extends('layouts/templateAdmin')
@section('title', 'Evénements')
@section('alerts')
@if (session('status'))
<div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" id="Alert" role="alert"
    data-dismiss="alert">
    {{ session('status') }}
</div>
@endif
@endsection

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="header-pretitle">
                                Overview
                            </h6>
                            <h1 class="header-title">
                                Evénements
                            </h1>
                        </div>
                        <div class="col-auto">
                            <a href="{{action('EventController@create')}}" class="btn btn-primary">
                                Créer un événement
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="eventTable" class="card mt-3" data-toggle="lists"
                data-lists-values='["event-name", "event-annonceur", "event-customer", "event-place","event-type", "event-date"]'>
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <form class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <span class="fe fe-search text-muted"></span>
                                </div>
                                <div class="col">
                                    <input type="search" class="form-control form-control-flush search"
                                        placeholder="Recherche">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="event-name">
                                        Nom
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="event-annonceur">
                                        Annonceur
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="event-customer">
                                        Client
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="event-place">
                                        Lieu
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="event-type">
                                        Type
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="event-date">
                                        Date
                                    </a>
                                </th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach ($events as $event)
                            <tr>
                                <td class="event-name">
                                    <a href="{{route('show_event', $event->id)}}"><b>{{ $event->name }}</b></a>
                                </td>
                                <td class="event-annonceur">{{ $event->advertiser }}</td>

                                @if($event->customer)
                                <td class="event-customer">{{ $event->customer->title }}</td>
                                @else
                                <td class="event-customer text-muted">___</td>
                                @endif
                                @if(isset($event->location["city"]))
                                <td class="event-place"> {{ $event->location["city"] }}</td>
                                @else
                                <td class="event-place">...</td>
                                @endif
                                <td class="event-type">
                                    <div class="badge badge-soft-primary">{{ $event->type }}</div>
                                </td>
                                <td class="event-date">{{ date('d/m/y', strtotime($event->start_datetime)) }} </td>
                                <td class="event-is_ready">
                                    @if ($event->is_ready == true)<span class="badge badge-soft-success">Ready</span>
                                    @else <span class="badge badge-soft-secondary">Not Ready</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection