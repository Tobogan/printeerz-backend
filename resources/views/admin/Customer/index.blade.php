@extends('layouts/templateAdmin')
@section('title', 'Clients')

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
                                Clients
                            </h1>
                        </div>
                        <div class="col-auto">
                            <a href="{{action('CustomerController@create')}}" class="btn btn-primary">
                                Créer un client
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="customerTable" class="card mt-3" data-toggle="lists"
                data-lists-values='["customer-name", "customer-contact-name", "customer-address", "customer-postal", "customer-city", "customer-total"]'>
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
                                    <a href="#" class="text-muted sort" data-sort="customer-city">
                                        Ville
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="customer-total">
                                        Activité
                                    </a>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach ($customers as $customer)
                            <tr>
                                <td class="customer-name"><a
                                        href="{{route('show_customer', $customer->id)}}"><b>{{ $customer->title }}</b></a>
                                </td>
                                @if(isset($customer->contact_person['lastname']) &&
                                isset($customer->contact_person['firstname']))
                                <td class="customer-contact-name">
                                    {{ $customer->contact_person['firstname'] . ' ' . $customer->contact_person['lastname'] }}
                                </td>
                                @else
                                <td>...</td>
                                @endif
                                @if(isset($customer->location['address']))
                                <td class="customer-address">{{ $customer->location['address'] }}</td>
                                @else
                                <td>...</td>
                                @endif
                                @if(isset($customer->location['city']))
                                <td class="customer-city">{{ $customer->location['city'] }}</td>
                                @else
                                <td>...</td>
                                @endif
                                <td class="customer-total">{{ $customer->activity_type }}</td>
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