@extends('layouts/templateAdmin')

@section('content')

@if (session('status'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">

            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                Overview
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title">
                                Clients
                            </h1>

                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <a href="{{action('CustomerController@create')}}" class="btn btn-primary">
                                Créer un client
                            </a>

                        </div>
                </div>
            </div>

            <!-- Card -->
            <div id="customerTable" class="card mt-3" data-toggle="lists" data-lists-values='["customer-name", "customer-contact-name", "customer-address", "customer-postal", "customer-city", "customer-total"]'>
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Search -->
                            <form class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <span class="fe fe-search text-muted"></span>
                                </div>
                                <div class="col">
                                    <input type="search" class="form-control form-control-flush search" placeholder="Recherche">
                                </div>
                            </form>

                        </div>
                    </div> <!-- / .row -->
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="customer-name">
                                        Nom
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="customer-contact-name">
                                        Nom du contact
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="customer-address">
                                        Adresse
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="customer-postal">
                                        Code Postal
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="customer-city">
                                        Ville
                                    </a>
                                </th>
                                <th colspan="2">
                                    <a href="#" class="text-muted sort" data-sort="customer-total">
                                        Nb d'événements
                                    </a>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="list">
                                @foreach ($customers as $customer)
                                <tr>
                                    <td class="customer-name"><a href="{{route('show_customer', $customer->id)}}">{{ $customer->denomination }}</a></td>
                                    <td class="customer-contact-name">{{ $customer->contact_prenom . ' ' . $customer->contact_nom }}</td>
                                    <td class="customer-address">{{ $customer->adresse }}</td>
                                    <td class="customer-postal">{{ $customer->code_postal }}</td>
                                    <td class="customer-city">{{ $customer->ville }}</td>
                                    <td class="customer-total">{{ $customer->nb_events }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                data-boundary="window">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('show_customer', $customer->id)}}" class="dropdown-item">
                                                    Voir le client
                                                </a>
                                            </div>
                                        </div>
                                    </td>        
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div> <!-- / .row -->
</div>

@endsection