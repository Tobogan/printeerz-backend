@extends('layouts/templateAdmin')

@section('content')

<div id="tabs">

    @include('admin.Customer.includes.header')

    <!-- #OVERVIEW -->
    <div class="container" id="overview">
        <div class="row">
            @forelse($customer->event as $event)

            <div class="col-12 col-lg-4">

                <div class="card">
                    <div class="card-body text-center">

                        <a href="profile-posts.html" class="avatar avatar-xl card-avatar">
                            @if($event->logoName)
                            <img src="/uploads/{{$event->logoName}} " class="avatar-img rounded-circle border border-4 border-card"
                                alt="...">
                            @else
                            <span class="avatar-title rounded-circle">{{ $event->nom[0] }}</span>
                            @endif
                        </a>

                        <h2 class="card-title">
                            <a href="profile-posts.html">{{ $event->nom }}</a>
                        </h2>

                        <p class="card-text text-muted">
                            <small>
                                {{ $event->lieu }}
                            </small>
                        </p>

                        <p class="card-text">
                            <span class="badge badge-soft-secondary">
                                {{ $event->type }}
                            </span>
                        </p>

                        <hr>

                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto">

                                <small>
                                    {{ date('d/m/Y', strtotime($event->date)) }}
                                </small>

                            </div>
                            <div class="col-auto">

                                <a href="{{route('show_event', $event->id)}}" class="btn btn-sm btn-primary">
                                    Voir
                                </a>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            @empty
            <li class="list-group-item">
                <span class="name">Aucun événement</span>
            </li>
            @endforelse

        </div> <!-- / .row -->
    </div>

    <!-- #INFORMATIONS -->
    <div class="container" id="informations">
        <div class="row">
            <div class="col-12 col-lg-8">

                <!-- Card -->
                <div class="card">

                    <div class="card-body">

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Adresse
                                </h5>

                            </div>
                            <div class="col-auto">

                                <time class="small text-muted" datetime="1988-10-24">
                                    {{ $customer->adresse .' '. $customer->code_postal .' '. $customer->ville }}
                                </time>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    SIREN
                                </h5>

                            </div>
                            <div class="col-auto">

                                <span class="small text-muted">
                                    {{ $customer->siren }}
                                </span>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Activité
                                </h5>

                            </div>
                            <div class="col-auto">

                                <small class="text-muted">
                                    {{ $customer->activite }}
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-4">

                <!-- Card -->
                <div class="card">
                    <div class="card-header">

                        <!-- Title -->
                        <h4 class="card-header-title">
                            Contact
                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Nom
                                </h5>

                            </div>
                            <div class="col-auto">

                                <time class="small text-muted" datetime="1988-10-24">
                                        {{ $customer->contact_nom }}
                                </time>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Prénom
                                </h5>

                            </div>
                            <div class="col-auto">

                                <span class="small text-muted">
                                        {{ $customer->contact_prenom }}
                                </span>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Téléphone
                                </h5>

                            </div>
                            <div class="col-auto">

                                <small class="text-muted">
                                        {{ $customer->contact_telephone }}
                                </small>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Poste
                                </h5>

                            </div>
                            <div class="col-auto">

                                    <small class="text-muted">
                                        {{ $customer->contact_poste }}
                                    </small>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>

    <!-- #COMMENTS -->
    <div class="container" id="comments">
        <div class="row">
            <div class="col-12">
                @if($customer->informations)
                {{ $customer->informations }}
                @endif
            </div>
        </div> <!-- / .row -->
    </div>
</div>


@include('admin.Customer.includes.modalDelete')
@endsection